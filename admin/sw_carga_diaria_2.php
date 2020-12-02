<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{
        $menu_actual="sw";
        $submenu_actual="sw_carga_diaria";
        $seccion_comentarios = $comentarios['sw_carga_diaria'];//mis cuotas
        $demo_seccion = $demo['sw_carga_diaria'];
        $nombre_pestana_navegador='Estudios';
        
        $datetime_now = new DateTime();
        $date_hoy = new DateTime();
        $datetime_now = $datetime_now->format('Y-m-d H:i:s');
        $year = $date_hoy->format('Y');
        $date_hoy = $date_hoy->format('Y-m-d');
        $data = explode(" ", $datetime_now);
        $ano_actual =  date("Y");
        $mes_actual =  date("m");
?> 

<!DOCTYPE html> 
<html lang="es"> 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $nombre_pestana_navegador;?> | Carga Diaria</title>

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

    .boton_informe_jugador{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #555555; 
        color: #555555;
        border-radius:5px;
    }
    .boton_informe_jugador:hover{
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
        background-color: #28b779;
        border: 3px solid black; 
        color: black;
        border-radius:5px;
    }
    .boton_menu{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #28b779; 
        color: #28b779;
        border-radius:5px;
    }
    .boton_menu:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: #28b779;
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
        color: #28b779;
    }

    .panel_buscar:hover{
        background-color:#ffbb00;
        color:white;
    }
    .boton_volver{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 1px solid #28b779; 
        color: #28b779;
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
    
    .boton_eliminar{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: #28b779;
        border-left:1px solid  #28b779; 
        border-right: 1px solid  #28b779;
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
        background-color: #28b779;
        border: 3px solid black; 
        color: black;
        border-radius:5px;
    }


    
    .boton_editar{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #28b779; 
        color: #28b779;
        border-radius:2px;
    }
    .boton_editar:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #fda101; 
        color: #fda101;
        border-radius:2px;
    }
    .boton_editar:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: rgba(0, 0, 0, .2);
        border-radius:2px;
    }
    
    .boton_ver{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #28b779; 
        color: #28b779;
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
    
    .boton_add{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #28b779; 
        color: #28b779;
        border-radius:2px;
    }
    .boton_add:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid black; 
        color: black;
        border-radius:2px;
    }
    .boton_add:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: rgba(0, 0, 0, .2);
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
    
    .boton_gestionar_cargos{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #28b779; 
        color: #28b779;
        border-radius:2px;
    }
    .boton_gestionar_cargos:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid black; 
        color: black;
        border-radius:2px;
    }
    .boton_gestionar_cargos_eliminar{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #28b779; 
        color: #28b779;
        border-radius:2px;
    }
    .boton_gestionar_cargos_eliminar:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #D83F25; 
        color: #D83F25;
        border-radius:2px;
    }
    .boton_gestionar_cargos:disabled{
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
        background-color: #28b779;
        border: 1px solid #28b779; 
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
    border: 2px solid #28b779;
    color: #28b779;
    width: 40px;
    height:28px;
    margin-left: 10px;
}
.btn-upload:hover{
    border: 2px solid #000;
    color: #000;
}
.boton_informe_jugador{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #555555; 
        color: #555555;
        border-radius:5px;
    }
    .boton_informe_jugador:hover{
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
.boton_informe_jugador:disabled{
    opacity: 0.5;
    cursor: no-drop;
}

/* ---------------- Estilos (Edgar Aldana) -------------------*/

.cuadro_serie_masculino{
    cursor: pointer;
    text-shadow: none; 
    background-color: #137049;
    /*background-color: #2684FF;*/
    /*border: 1px solid #28b779;*/
    color: white;
    border-radius:10px;
}   

.cuadro_serie_fememino{
    cursor: pointer;
    text-shadow: none; 
    background-color: #137049;
    /*background-color: #ED293D;*/
    /*border: 1px solid #28b779;*/ 
    color: white;
    border-radius:10px;
}   

    .boton_volver_a_series{
        position: absolute;
        text-shadow: none; 
        background-color: #28b779;
        border: 5px solid white;     
        color: white;
        border-radius: 50%;
        padding: 13px;
    }
    .boton_volver_a_series:hover{
        position: absolute;
        text-shadow: none; 
        background-color: #28b779;
        border: 5px solid white;     
        color: white;
        border-radius: 50%;
        padding: 13px;
    }

    #ingresar_peso_ideal_informe_carga::placeholder {
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



var id_jugador = "";
var id_informe = "";
var cierra_ventana=0;

var id_matricula="";
var id_mensualidad="";
var edicion_informe = false;
var agregar_informe = true;
var linea_actual=0;
var pagina_actual=0;
var semestre1= true;
var semestre2 = true;

var error_foto = 0;
var jugadores_scouting = {};
var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');


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
    $('#cargando_pagina').hide();
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
<!--breadcrumbs-->
  <div id="content-header">
   <div id="breadcrumb"> 
        <a title="Go to Home" class="tip-bottom">
            <i class="icon-home"></i> Inicio
        </a> 
        <a class="tip-bottom">
            <i class="icon-truck"></i> Estudios
        </a> 
        <a class="current">
            Registro
        </a> 
    
    </div>
  </div>
<!--End-breadcrumbs-->
 
<div class="container-fluid" id="cargando_pagina">
    <center>
    <img src="" style="margin-top:100px;" id="cargando_final">
    <script>$('#cargando_final').attr('src',imagen_cargando.src);</script>
    </center>
</div>
<!--Action boxes-->


<div class="container-fluid" style="display:none;" id="pagina">
      
    
<?php if(($software_demo && $demo_seccion) || !$software_demo){?>


<div class="row-fluid">

<!--
cuadro_listado_series_registro_cargas_diarias
cuadro_serie_selected_registro_cargas_diarias
cuadro_guardar_informe_cargas_diarias_serie_selected
-->

<!-- ========================================== Inicio del id="cuadro_listado_series_registro_cargas_diarias" ========================================== -->     
<div class="row-fluid" style="margin-top: 0px; color:black; font-family:Arial, Helvetica, sans-serif;" id="cuadro_listado_series_registro_cargas_diarias"> 

<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
<div class="cuadro_buscar_titulo">
<center>

<table style="color:black; font-family:Arial, Helvetica, sans-serif;margin-top: -40px">
  <tr class="sin_fondo">
    <td style="padding:12px; padding-top:15px;">
    <table>
  <tr class="sin_fondo">
    <td><center><img src="img/logo_informe_medico.png" style="width:75px; margin-top:5px;"></center></td>
  </tr>
</table>
    </td>
    <td>
    <div style="padding:0px; margin:0px; margin-top:-35px;">
    <h3 class="titulo_principal"><center>REGISTRO DE CARGAS DIARIAS</center></h3>
     <center>
    <!--<b style="font-size:10px; color:black; margin-top:15px;" class="nombre_serie"></b>-->
    </center>
                      
    </div>
    </td>
  </tr>
</table>
<br>
</center>

</div>
<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">

  <div style="/*background-color: red;*/ width: 80%; margin: auto;">
    
    <div class="row-fluid" style="margin-top:0px;">     
      
      <?php  
      $contador = 0;
      $sexo = "";
      $serie = "";
      $numero_serie = "";
      $tecnico = "";
      while ( $contador <= 3 ) {

        switch ( $contador ) {
          case 0:
            $sexo = 1;
            $serie = "SUB-8";            
            $numero_serie = 8;
            $tecnico = "Jesús Estrada";
            break;

          case 1:
            $sexo = 1;
            $serie = "SUB-9";
            $numero_serie = 9;
            $tecnico = "Arturo Medina";            
            break;

          case 2:
            $sexo = 1;
            $serie = "SUB-10";
            $numero_serie = 10;
            $tecnico = "Juan Carrasco";            
            break;

          case 3:
            $sexo = 1;
            $serie = "SUB-11";
            $numero_serie = 11;
            $tecnico = "Fabián Quiroz";            
            break;                                    
          
        }

      ?>
      <div class="span3">  
        <div sexo="<?php echo $sexo; ?>" serie="<?php echo $serie; ?>" numero-serie="<?php echo $numero_serie; ?>" tecnico="<?php echo $tecnico; ?>" class="cuadro_serie cuadro_serie_masculino" style="padding: 5px;">
          <center>
            <img src="img/logo_informe_medico.png" style="width:100px; margin-top:5px;">
          </center>
          <br/>
          <div style="border-bottom: 3px solid; border-top: 3px solid; text-align: center; height: 20px; margin-top: -15px;"> 
            <h4 style="margin-top: 0px;"><?php echo $serie; ?> </h4>
          </div>  
          <br/>
          <div style="text-align: center; height: 20px; margin-top: -15px;"> 
            <i class="icon-male"></i> <span class="cantidad-jugadores" sexo="<?php echo $sexo; ?>" style="font-weight: bold;">(0) jugadores</span>
          </div>                    
        </div>      
      </div>
      <?php  
      $contador++;
      }
      ?>      

    </div>
    <!-- ============================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->    
    <div class="row-fluid" style="margin-top:20px;">     
      
      <?php  
      $contador = 0;
      while ( $contador <= 3 ) {

        switch ( $contador ) {
          case 0:
            $sexo = 1;
            $serie = "SUB-12";
            $numero_serie = 12;
            $tecnico = "Miguel Valenzuela";                        
            break;

          case 1:
            $sexo = 1;
            $serie = "SUB-13";
            $numero_serie = 13; 
            $tecnico = "Alexis Rivero";           
            break;

          case 2:
            $sexo = 1;
            $serie = "SUB-14"; 
            $numero_serie = 14;
            $tecnico = "Germán Calderón";           
            break;

          case 3:
            $sexo = 1;
            $serie = "SUB-15";
            $numero_serie = 15;         
            $tecnico = "Ernesto Quintero";   
            break;                                    
          
        }

      ?>
      <div class="span3">  
        <div sexo="<?php echo $sexo; ?>" serie="<?php echo $serie; ?>" numero-serie="<?php echo $numero_serie; ?>" tecnico="<?php echo $tecnico; ?>" class="cuadro_serie cuadro_serie_masculino" style="padding: 5px;">
          <center>
            <img src="img/logo_informe_medico.png" style="width:100px; margin-top:5px;">
          </center>
          <br/>
          <div style="border-bottom: 3px solid; border-top: 3px solid; text-align: center; height: 20px; margin-top: -15px;"> 
            <h4 style="margin-top: 0px;"><?php echo $serie; ?> </h4>
          </div>  
          <br/>
          <div style="text-align: center; height: 20px; margin-top: -15px;"> 
            <i class="icon-male"></i> <span class="cantidad-jugadores" sexo="<?php echo $sexo; ?>" style="font-weight: bold;">(0) jugadores</span>
          </div>                    
        </div>      
      </div>
      <?php  
      $contador++;
      }
      ?>   

    </div>

    <!-- ============================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->    
    <div class="row-fluid" style="margin-top:20px;">     
      
      <?php  
      $contador = 0;
      while ( $contador <= 3 ) {

        $serie = "";

        switch ( $contador ) {
          case 0:
            $sexo = 1;
            $serie = "SUB-16";
            $numero_serie = 16;
            $tecnico = "Pedro Seijas";            
            break;

          case 1:
            $sexo = 1;
            $serie = "SUB-17";
            $numero_serie = 17;
            $tecnico = "Willian Valera";            
            break;

          case 2:
            $sexo = 1;
            $serie = "SUB-19";
            $numero_serie = 19;
            $tecnico = "Carlos Ramírez";            
            break;

          case 3:
            $sexo = 1;
            $serie = "Primer Equipo";
            $numero_serie = 99;            
            $tecnico = "Daniel Páez";
            break;                                    
          
        }

      ?>
      <div class="span3">  
        <div sexo="<?php echo $sexo; ?>" serie="<?php echo $serie; ?>" numero-serie="<?php echo $numero_serie; ?>" tecnico="<?php echo $tecnico; ?>" class="cuadro_serie cuadro_serie_masculino" style="padding: 5px;">
          <center>
            <img src="img/logo_informe_medico.png" style="width:100px; margin-top:5px;">
          </center>
          <br/>
          <div style="border-bottom: 3px solid; border-top: 3px solid; text-align: center; height: 20px; margin-top: -15px;"> 
            <h4 style="margin-top: 0px;"><?php echo $serie; ?> </h4>
          </div>  
          <br/>
          <div style="text-align: center; height: 20px; margin-top: -15px;"> 
            <i class="icon-male"></i> <span class="cantidad-jugadores" sexo="<?php echo $sexo; ?>" style="font-weight: bold;">(0) jugadores</span>
          </div>                    
        </div>      
      </div>
      <?php  
      $contador++;
      }
      ?>      

    </div>    

    <!-- ============================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->    
    <div class="row-fluid" style="margin-top:20px;">     
      
      <?php  
      $contador = 0;
      while ( $contador <= 1 ) {

        $serie = "";

        switch ( $contador ) {
          case 0:
            $sexo = 2;
            $serie = "SUB-17";
            $numero_serie = 17;
            $tecnico = "Alejandro Landaeta";
            break;

          case 1:
            $sexo = 2;
            $serie = "Primer Equipo";
            $numero_serie = 99;
            $tecnico = "Eduardo Escalona";            
            break;                          
          
        }

      ?>
      <div class="span3">  
        <div sexo="<?php echo $sexo; ?>" serie="<?php echo $serie; ?>" numero-serie="<?php echo $numero_serie; ?>" tecnico="<?php echo $tecnico; ?>" class="cuadro_serie cuadro_serie_fememino" style="padding: 5px;">
          <center>
            <img src="img/logo_informe_medico.png" style="width:100px; margin-top:5px;">
          </center>
          <br/>
          <div style="border-bottom: 3px solid; border-top: 3px solid; text-align: center; height: 20px; margin-top: -15px;"> 
            <h4 style="margin-top: 0px;"><?php echo $serie; ?> </h4>
          </div>  
          <br/>
          <div style="text-align: center; height: 20px; margin-top: -15px;"> 
            <i class="icon-male"></i> <span class="cantidad-jugadores" sexo="<?php echo $sexo; ?>" style="font-weight: bold;">(0) jugadores</span>
          </div>                    
        </div>      
      </div>
      <?php  
      $contador++;
      }
      ?>     

    </div>

  </div>

</div>



</div>
<!-- ========================================== Fin del id="cuadro_listado_series_registro_cargas_diarias" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_serie_selected_registro_cargas_diarias" ========================================== -->
<div style=" display:none;" id="cuadro_serie_selected_registro_cargas_diarias">

<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
<div class="cuadro_buscar_titulo">
<center>

<table style="color:black; font-family:Arial, Helvetica, sans-serif;margin-top: -40px">
  <tr class="sin_fondo">
    <td style="padding:12px; padding-top:15px;">
    <table>
  <tr class="sin_fondo">
    <td><center><img src="img/logo_informe_medico.png" style="width:75px; margin-top:5px;"></center></td>
  </tr>
</table>
    </td>
    <td>
    <div style="padding:0px; margin:0px; margin-top:-35px;">
    <h3 class="titulo_principal"><center>CARGA DIARIA</center></h3>
    <div style="text-align: center; height: 20px; margin-top: -15px;"> 
        <h5 class="titulo_serie" style="margin-top: 0px;"></h5>
      <input class="sexo" type="hidden">
      <input class="numero_serie" type="hidden">
      <input class="tecnico" type="hidden">
    </div>
     <center>
    <!--<b style="font-ssize:10px; color:black; margin-top:15px;" class="nombre_serie"></b>-->
    </center>
                      
    </div>
    </td>
  </tr>
</table>
<br>
</center>

<div style="width:100%; background-color:#28b779; height:20px;">

</div>

</div>
<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

                        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
                          
                          <div class="row-fluid" style="margin: 0px;">
                            <button class="boton_volver" onclick="boton_volver_cuadro_listado_series_registro_cargas_diarias();" style="float:left; margin:0px;">
                              <i class="icon-arrow-left"></i> volver
                            </button>
                          </div>        

                          <center>
                                <div style=" width:600px; margin-bottom:10px;">
                                  
                                     <table border="0">
                                        <tbody>
                                        <tr class="sin_fondo">
                                          <td style="width:330px; padding-left:40px;">
                                            <h5 style="text-align: center;">FILTRAR BÚSQUEDA</h5>
                                          </td>
                                        </tr>              
                                      </tbody></table>
                                      <br>
                                      <div class="span3" style="width: 45%;margin: 0px;margin-left: 20px;display: flex;">
                                        <a class="btn btn-md btn-primary" style="margin: 0px; width: 35%; border-bottom-left-radius: 2px; border-top-left-radius: 2px; margin-left: 0px; margin-right: 0px; margin-top: 0px; font-size: 13px; margin-bottom: 0px; background-color: #555555;"> 
                                          Fecha inicio
                                        </a>
                                        <input readonly class="date_fechaNacimiento" type="text" style="background-color: white; margin: 0px; width: 65%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: left; line-height: 16px;" name="ingresar_inicio" id="ingresar_inicio" onchange="buscador();" />
                                      </div>
  
                                      <div class="span3" style="width: 45%;margin: 0px;margin-left: 20px;display: flex;">
                                        <a class="btn btn-md btn-primary" style="margin: 0px; width: 35%; border-bottom-left-radius: 2px; border-top-left-radius: 2px; margin-left: 0px; margin-right: 0px; margin-top: 0px; font-size: 13px; margin-bottom: 0px; background-color: #555555;"> 
                                          Fecha fin
                                        </a>
                                        <input readonly class="date_fechaNacimiento" type="text" style="background-color: white; margin: 0px; width: 65%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: left; line-height: 16px;" name="ingresar_fin" id="ingresar_fin" onchange="buscador();" />
                                      </div>
                                         
                                 </div>
                                          
                                       <div style="margin:0px; height:20px;"><img src="img/cargando_buscar.gif" id="cargando_buscar" style="display: block;">
                                        <span style="color:#dc4e4e; display:block;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                        <span style="color:#28b779; display:block;" id="sin_resultados">Busqueda sin resultados.</span>
                                       </div>
                                       
                               </center>
                            
                            <div class="row-fluid" style="margin-top:0px;">

                              <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onClick="boton_agregar_informe_carga();"><b style="font-size:13px;"><i class="icon-plus"></i> NUEVA CARGA</b></button>

                                <div class="span12" style="margin: 0px;">
                                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_informes_todos">
                                        <thead>
                                            <tr style="background-color:#555555; color:white;">
                                                <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 80px;">
                                                  <div class="tip-top" data-original-title="Número" style="width:100%;">Nº</div>
                                              </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 210px;">
                                                    <div class="tip-top" data-original-title="Fecha de entrenamiento" style="width:100%;text-align: left">FECHA ENTRENAMIENTO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 150px;">
                                                    <div class="tip-top" data-original-title="Serie" style="width:100%;">SERIE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 150px;">
                                                    <div class="tip-top" data-original-title="Técnico" style="width:100%;">TÉCNICO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 150px;">
                                                    <div class="tip-top" data-original-title="Jugadores" style="width:100%;">JUGADORES</div>
                                                </th>                                                
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 250px;">
                                                    <div class="tip-top" data-original-title="Jugadores sobre el peso" style="width:100%;">JUGADORES SOBRE EL PESO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 250px;">
                                                    <div class="tip-top" data-original-title="Jugadores peso normal" style="width:100%;">JUGADORES PESO NORMAL</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:30px;" colspan="3"></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody><!--  AQUI SE INSERTARAN CON JAVASCRIPT --></tbody>
                                        
                                        <tfoot>

                                            <!--
                                            <tr class="sin_fondo"><td colspan="8"><center><h5 style="color:#555555;"><i class="icon-file-alt"></i> Sin Jugadores</h5></center></td></tr>
                                            -->
                                            
                                            <tr style="background-color:#555555; color:white;">
                                                <th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                                            </tr>

  
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
        
</div>
<!-- ========================================== Fin del id="cuadro_serie_selected_registro_cargas_diarias" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_guardar_informe_cargas_diarias_serie_selected" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_guardar_informe_cargas_diarias_serie_selected">

<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
<div class="cuadro_buscar_titulo">
<center>

<table style="color:black; font-family:Arial, Helvetica, sans-serif;margin-top: -40px">
  <tr class="sin_fondo">
    <td style="padding:12px; padding-top:15px;">
    <table>
  <tr class="sin_fondo">
    <td><center><img src="img/logo_informe_medico.png" style="width:75px; margin-top:5px;"></center></td>
  </tr>
</table>
    </td>
    <td>
    <div style="padding:0px; margin:0px; margin-top:-35px;">
    <h3 class="titulo_principal"><center>CARGA DIARIA</center></h3>
    <div style="text-align: center; height: 20px; margin-top: -15px;"> 
      <h5 class="titulo_serie" style="margin-top: 0px;"></h5>
    </div>
     <center>
    <!--<b style="font-size:10px; color:black; margin-top:15px;" class="nombre_serie"></b>-->
    </center>
                      
    </div>
    </td>
  </tr>


</table>
                          <div class="row-fluid" style="margin: 0px;">
                            <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px;">
                              <i class="icon-arrow-left"></i> volver
                            </button>
                          </div>

<br>
</center>   

<div style="width:100%; background-color:#28b779; height:20px;">

</div>

</div>
<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

                        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
                               
                          <center>
                                <div style=" width:600px; margin-bottom:10px;">
                                  
                                     <table border="0">
                                        <tbody>
                                        <tr class="sin_fondo">
                                          <td style="width:330px; padding-left:40px;">
                                            <h5 style="text-align: center; color: black;">LISTADO DE JUGADORES ACTIVOS</h5>
                                          </td>
                                        </tr>
                                        <tr class="sin_fondo">
                                          <td style="width:330px; padding-left:40px;">
                                            <p style="text-align: center; color: black;"><b>NOTA:</b> Asegúrate de mantener actualizado el peso ideal de cada jugador!</p>
                                          </td>
                                        </tr>                                                      
                                      </tbody></table>
                                      <br>
                                         
                                 </div>
                                  
                                  <!--                                          
                                       <div style="margin:0px; height:20px;"><img src="img/cargando_buscar.gif" id="cargando_buscar" style="display: block;">
                                        <span style="color:#dc4e4e; display:block;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                        <span style="color:#28b779; display:block;" id="sin_resultados">Busqueda sin resultados.</span>
                                       </div>
                                  -->
                                       
                               </center>
                            
                            <div class="row-fluid" style="margin-top:0px;">

                            <form method="post" ng-model="formulario_registro" name="formulario_registro" id="formulario_registro" novalidate>

                                <div class="span12" style="margin: 0px;">
                                  <table class="table-striped" style="border: 3px solid #28b779; width:100%;" id="tabla_ver_informes">
                                    <tbody>

            <!--
                <tr style="cursor: pointer;" onclick="// verJugadores();">
                  
                  <td style="padding: 10px;">
                    <center><b>#1</b></center>
                  </td>
                  
                  <td>
                    <center>
                      <img src="img/chile.png" style="width: 25px;"> <b>Arquero</b>
                    </center>
                  </td>
                  
                  <td style="width: 700px">
                    <center>
                      <img src="../foto_jugadores/" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px"> 
                      <b>Cristian Fuente Lopez</b>                      
                    </center>
                  </td>

                  <td style="width: 200px; padding: 12px;">
                    <center>
                      <select style="margin: 0px; max-height: 32px; height: 40px; width: 100%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_cometidas_informe_carga" id="ingresar_cometidas_informe_carga">

                      </select>
                    </center>
                  </td>
                  <td style="width: 200px; padding: 12px;">
                    <center><input style="margin: 0px; max-height: 32px; height: 26px; width: 100%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #28b779; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="buscar_allo" id="buscar_allo" onchange="buscador();" type="" name="">
                    </center>
                  </td>
                  <td style="width: 200px; padding: 20px;">
                    <center><input style="color: white; margin: 0px; max-height: 26px; height: 32px; width: 100%; -webkit-appearance: none; -moz-appearance: none; background-color: #28b779; border: 2px solid #28b779; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="peso_ideal" id="peso_ideal" type="text" placeholder="Ingrese peso ideal">
                    </center>
                  </td>                  
                </tr>
            -->

              </tbody>
              <!--
              <tfoot>
                <tr><td colspan="6"></td></tr>
              </tfoot>
              -->
              </table>
            
            </form>


<div class="span12" style=" margin-top: 20px;">
            
            <center>
        <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar();" id="boton_agregar_informe_carga"><i class="icon-save"></i> GUARDAR INFORME DE CARGA</button>
      </center>
      </div>

                          <div class="row-fluid" style="margin: 0px;">
                            <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px;">
                              <i class="icon-arrow-left"></i> volver
                            </button>
                          </div>

                                </div>
                            </div>
                        </div>
        
</div>
<!-- ========================================== Fin del id="cuadro_guardar_informe_cargas_diarias_serie_selected" ========================================== -->

  
<div id="myModalDescargarBoleta" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: #28b779; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_DescargarBoleta">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:#28b779; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_registro();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    

<div id="myModalDescargarExcel" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: #28b779; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_agregar_DescargarExcel">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:#28b779; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="boton_aceptar_excel();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>

<div id="myModal2" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: #28b779; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_proveedor" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:#28b779; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_informe();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>


<!-- VIEW JUGADOR -->
<div id="view_ejercicio" class="modal hide" style="border-radius:10px; width: 700px; height: 500px;">

    <div class="modal-header" style="margin-left: 1px; background-color: white; border: white; border-top-right-radius: 5px; border-top-left-radius: 5px;height: 20px">
        <div>

            <hr style="display: inline-block; margin-right: 30px; width: 270px; border: 1px solid #e3e3e3;">
            <img src="img/logo_informe_medico.png" style="width:75px; margin-top:5px;">
            
            <hr style="display: inline-block; margin-left: 30px; width: 250px; border: 1px solid #e3e3e3;">
            <h3 style="margin-left: 17px;"><center>CARGA DIARIA</center></h3>

            <!-- <div class="hr-line"></div>
            <fieldset>
                <legend>
                    <img src="img/logo_informe_medico.png" style="width:75px; margin-top:5px;">
                </legend>
            </fieldset>
             -->
        </div>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button>
    </div>
    
    
    <div class="modal-body">
        
    </div>


</div>
<!-- FIN VIEW JUGADOR -->


<div id="myModal1" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: #28b779; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_agregar_proveedor" style="color:black;">
              <h5>¿Estás seguro que quieres agregar este Proveedor?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:#28b779; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="guardar_registro();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
      
      
<div id="myModalComentario" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: #28AEB7; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_agregar_comentario">
              <h5>¿Estás seguro que quieres agregar este comentario?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:#28AEB7; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;" ng-click="activarBoton()"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="enviar_comentario();" ng-click="desactivarBoton()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
      
      
  </div>
  
  <?php }?>
</div>
</div>





</div>
<!--end-main-container-part-->
<!--Footer-part-->
<div class="row-fluid" style="color: white;">
    <div id="footer" class="span12"> &copy; <?php echo date("Y"); ?> | <?php echo $abreviacion_dominio;?>&#x2122;. Todos los derechos reservados.</div>
</div>
<!--end-Footer-part-->
</body>
</html>

<?php 
    }
?>


<script>

    // -------------------- Inicio de la función 'get_cantidad_jugadores_sexo_serie()' -------------------- // 
    function get_cantidad_jugadores_sexo_serie(){

        let array_sexo = [];
        let array_numero_serie = [];
        $(".cuadro_serie").each(function(i){

            let sexo = $(this).attr("sexo");
            let numero_serie = $(this).attr("numero-serie");

            array_sexo[i] = sexo;
            array_numero_serie[i] = numero_serie;

        });

        $.ajax({
            url: "post/jugadores_ver_cantidad_sexo_serie.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
            'array_sexo': array_sexo,
            'array_numero_serie': array_numero_serie
            },success: function(respuesta){
                var count = 1;
                var x = [];
                for(var i=0; i < respuesta.length; i++) {   
                    x[i] = respuesta[i];
                }

                $(".cantidad-jugadores").each(function(i){
                    let sexo = $(this).attr("sexo");
                    if( sexo == "1" ) {
                        $(this).html( '(' + x[i] + ')' + ' jugadores' );
                    } else {
                        $(this).html( '(' + x[i] + ')' + ' jugadoras' );
                    } 
                });         
                
            },error: function(){// will fire when timeout is reached
                $('#cargando_buscar').hide();
                $('#sin_resultados').hide();
                $('#error_conexion').show();
                $('#boton_editar').hide();
                $('.boton_refresh').show();
            }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'get_cantidad_jugadores_sexo_serie()' -------------------- //
    get_cantidad_jugadores_sexo_serie();

function boton_mostrar_modal_descarga() {

    $('#view_ejercicio').modal('show');
    /*
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
    */
}

    // -------------------- Inicio de la función 'buscador_jugadres_sexo_serie()' -------------------- // 
    function buscador_jugadres_sexo_serie(){
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();
        /*
        var inicio = $("#ingresar_inicio").val();
        var fin = $("#ingresar_fin").val();

        if (inicio > fin) {
            inicio = fin;
            fin = $("#ingresar_inicio").val();
        }

        */

        var sexo = $(".sexo").val();
        var numero_serie = $(".numero_serie").val();

        $.ajax({
            url: "post/serie_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
            'sexo': sexo,
            'numero_serie': numero_serie
            },success: function(respuesta){
                // alert(JSON.stringify(respuesta));
                if(respuesta== ""){ //jugador sin informes
                    $("#tabla_ver_informes tbody").empty();
                    var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="6"><center><b>No existen jugadores registrados en este serie...</b></center></td></tr>';
                    $("#tabla_ver_informes tbody").append(markup);
                    $("#graficos_informes_resumen").hide();
                    $('#cargando_buscar').hide();
                    $('#sin_resultados').show();
                    $('#boton_editar').hide();
                    $('.boton_refresh').hide();
                    $('#boton_agregar_informe_carga').prop("disabled", true);
                }else{              
                    
                    $('#boton_agregar_informe_carga').prop("disabled", false); // <--- Habilitando el botón de guardar.

                    $("#tabla_ver_informes tbody").empty();
                    var count = 1;

                    for(var i=0; i < respuesta.length; i++){



                        if(typeof respuesta[i]['peso_informe_carga_individual'] === 'undefined') {
                            respuesta[i]['peso_informe_carga_individual'] = "";
                        }                   

                        if( respuesta[i]['peso_informe_carga_individual'] === null ) {
                            respuesta[i]['peso_informe_carga_individual'] = "";
                        }

                        // ----------------------------------------------------------------

                        if(typeof respuesta[i]['peso_ideal_informe_carga_individual'] === 'undefined') {
                            respuesta[i]['peso_ideal_informe_carga_individual'] = "";
                        }                   

                        if( respuesta[i]['peso_ideal_informe_carga_individual'] === null ) {
                            respuesta[i]['peso_ideal_informe_carga_individual'] = "";
                        }


                        if( respuesta[i]['apellido2'] === null ) {
                            respuesta[i]['apellido2'] = "";
                        }                       

                        var markup = 
                        '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">\
                            <td style="width: 50px;">\
                                <b>#'+count+'</b>\
                                <input type="hidden" value="'+ respuesta[i]['idfichaJugador'] +'" name="id_ficha_jugador[]" />\
                            </td>\
                            <td style="width: 300px;">\
                                <img src="img/chile.png" style="width: 25px;"> <b>Arquero</b>\
                            </td>\
                            <td style="width: 550px">\
                                <img src="foto_jugadores/'+respuesta[i]['idfichaJugador']+'.png" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"> \
                                <b>' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</b>\
                            </td>\
                            <td style="width: 350px; padding: 12px;">\
                                <center>\
                                <select style="margin: 0px; max-height: 32px; height: 40px; width: 100%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_faltas_cometidas_informe_carga[]" class="ingresar_faltas_cometidas_informe_carga" onchange="chequear_datos()">\
                                </select>\
                                </center>\
                            </td>\
                            <td style="width: 200px; padding: 12px;">\
                                <center><input style="margin: 0px; max-height: 32px; height: 26px; width: 100%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #28b779; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_informe_carga[]" id="ingresar_peso_informe_carga" type="text" placeholder="Ej: 12.33" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                                </center>\
                            </td>\
                            <td style="width: 200px; padding: 20px;">\
                                <center><input style="color: white; margin: 0px; max-height: 26px; height: 32px; width: 100%; -webkit-appearance: none; -moz-appearance: none; background-color: #28b779; border: 2px solid #28b779; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_ideal_informe_carga[]" id="ingresar_peso_ideal_informe_carga" type="text" placeholder="Ingrese peso ideal" value="' + respuesta[i]['peso_ideal_informe_carga_individual'] + '" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                                </center>\
                            </td>\
                        </tr>';
                        $("#tabla_ver_informes tbody").append(markup);
                        count = count + 1;
                    }
                
                    for (var i = 0; i <= 10; i++) {
                        if( i === 0 ) {
                            $(".ingresar_faltas_cometidas_informe_carga").append('<option value="0">Seleccione</option>');
                        } else {
                            $(".ingresar_faltas_cometidas_informe_carga").append('<option value="'+i+'">'+i+'</option>');
                        }
                        
                    }


                    $('#boton_agregar').show();
                    $('.boton_refresh').hide();
                } 
                $('#cargando_buscar').hide();
                $('#error_conexion').hide();
                $('#sin_resultados').hide();
            
            },error: function(){// will fire when timeout is reached
                $('#cargando_buscar').hide();
                $('#sin_resultados').hide();
                $('#error_conexion').show();
                $('#boton_editar').hide();
                $('.boton_refresh').show();
            }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'buscador_jugadres_sexo_serie()' -------------------- //

// -------------------------- Inicio de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //
function boton_agregar_informe_carga(){
    window.id_informe='';
    $("#tabla_ver_informes tbody").empty();

    var titulo_serie = $(".titulo_serie").html();        
    $(".titulo_serie").html( titulo_serie );
    

    $('#cuadro_serie_selected_registro_cargas_diarias').hide(500);
    $('#cuadro_guardar_informe_cargas_diarias_serie_selected').show(500);
        
    buscador_jugadres_sexo_serie();

}
// -------------------------- Fin de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //

// -------------------------- Inicio de la función 'boton_editar_informe_carga( id_informe_carga )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_informe_carga( id_informe_carga ){

    window.id_informe= id_informe_carga;
    $("#tabla_ver_informes tbody").empty();
    
    $('#cuadro_serie_selected_registro_cargas_diarias').hide(500);
    $('#cuadro_guardar_informe_cargas_diarias_serie_selected').show(500);
    // $('.boton_add').prop("disabled", false);
     $('#error_conexion').hide();
     $('#sin_resultados').hide();
     $('#cargando_buscar').show();
     
     /*
     var inicio = $("#ingresar_inicio").val();
     var fin = $("#ingresar_fin").val();

     if (inicio > fin) {
        inicio = fin;
        fin = $("#ingresar_inicio").val();
     }

     */

     var sexo = $(".sexo").val();
     var numero_serie = $(".numero_serie").val();

     $.ajax({
            url: "post/informe_carga_ver_filtro_id.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
            'id_informe_carga': id_informe_carga,
        },success: function(respuesta){
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_ver_informes tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="6"><center><b>No existen jugadores registrados en este serie...</b></center></td></tr>';
                $("#tabla_ver_informes tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_informe_carga').prop("disabled", true);
            }else{              
                var patron = window.patrones;

                $('#boton_editar').prop("disabled",false);
                $('#boton_agregar_informe_carga').prop("disabled", false);
                window.jugadores_scouting = respuesta; 
                $("#tabla_ver_informes tbody").empty();
                var count = 1;

                var array_faltas_cometidas_informe_carga_individual = [];

                for(var i=0; i < respuesta.length; i++){


                    array_faltas_cometidas_informe_carga_individual[i] = respuesta[i]['categoria_informe_carga_individual'];     

                    if( respuesta[i]['peso_ideal_informe_carga_individual'] === null ) {
                        respuesta[i]['peso_ideal_informe_carga_individual'] = "";
                    }

                    if( respuesta[i]['apellido2'] === null ) {
                        respuesta[i]['apellido2'] = "";
                    }   

                    var markup = 
                    '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">\
                        <td style="width: 50px;">\
                            <b>#'+count+'</b>\
                            <input type="hidden" value="'+ respuesta[i]['idfichaJugador'] +'" name="id_ficha_jugador[]" />\
                            <input type="hidden" value="'+ respuesta[i]['idinforme_carga_individual'] +'" name="idinforme_carga_individual[]" />\
                        </td>\
                        <td style="width: 300px;">\
                            <img src="img/chile.png" style="width: 25px;"> <b>Arquero</b>\
                        </td>\
                        <td style="width: 550px">\
                            <img src="foto_jugadores/'+respuesta[i]['idfichaJugador']+'.png" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"> \
                            <b>' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</b>\
                        </td>\
                        <td style="width: 350px; padding: 12px;">\
                            <center>\
                            <select style="margin: 0px; max-height: 32px; height: 40px; width: 100%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_faltas_cometidas_informe_carga[]" id="ingresar_faltas_cometidas_informe_carga_'+i+'" class="ingresar_faltas_cometidas_informe_carga" onchange="chequear_datos()">\
                            </select>\
                            </center>\
                        </td>\
                        <td style="width: 200px; padding: 12px;">\
                            <center><input style="margin: 0px; max-height: 32px; height: 26px; width: 100%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #28b779; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_informe_carga[]" id="ingresar_peso_informe_carga" type="text" value="'+respuesta[i]['peso_informe_carga_individual']+'" placeholder="Ej: 12.33" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                            </center>\
                        </td>\
                        <td style="width: 200px; padding: 20px;">\
                            <center><input style="color: white; margin: 0px; max-height: 26px; height: 32px; width: 100%; -webkit-appearance: none; -moz-appearance: none; background-color: #28b779; border: 2px solid #28b779; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_ideal_informe_carga[]" id="ingresar_peso_ideal_informe_carga" type="text" placeholder="Ingrese peso ideal" value="'+respuesta[i]['peso_ideal_informe_carga_individual']+'" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                            </center>\
                        </td>\
                    </tr>';
                    $("#tabla_ver_informes tbody").append(markup);
                    count = count + 1;
                }
                

                
                for ( var i = 0; i < array_faltas_cometidas_informe_carga_individual.length; i++ ) {
                    
                    // alert( "Recorrido Nº " + i + ': ' + array_faltas_cometidas_informe_carga_individual[i] );        

                    for (var j = 0; j <= 10; j++) {
                        // alert(j);
                        if( j === 0 ) {
                            $("#ingresar_faltas_cometidas_informe_carga_"+i+"").append('<option value="0">Seleccione</option>');
                        } else {

                            if( array_faltas_cometidas_informe_carga_individual[i] == j ) {
                                $("#ingresar_faltas_cometidas_informe_carga_"+i+"").append('<option selected value="'+j+'">'+j+'</option>');
                            } else {
                                $("#ingresar_faltas_cometidas_informe_carga_"+i+"").append('<option value="'+j+'">'+j+'</option>');
                            }   
                        }
                    }
                    
                }
                
                /*
                $("select[name^='ingresar_faltas_cometidas_informe_carga'] option").each(function(i){
                    let thisElement = $(this);
                    let thisValue = $(this).val();
                    alert( array_faltas_cometidas_informe_carga_individual[i] );
                    
                    if( thisValue == array_faltas_cometidas_informe_carga_individual[i] ){
                        thisElement.prop("selected", true);
                    }
                    
                });
                */



                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar').hide();
            $('#error_conexion').hide();
            $('#sin_resultados').hide();
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });

}
// -------------------------- Fin de la función 'boton_editar_informe_carga( id_informe_carga )' - EDITAR (UPDATE) --------------------------- //

function boton_eliminar( id_informe_carga ){
    window.id_informe= id_informe_carga;
    // alert( id_informe_carga );
    $('#myModal2').modal('show');
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

function eliminar_informe() {

    //alert( window.id_informe );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_proveedor').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/informe_carga_eliminar.php",
        type: "post",
        data: {
            'id': window.id_informe
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_proveedor').html('<h5>Informe eliminado correctamente!</h5>');
                boton_volver_serie_selected_registro_cargas_diarias();
                buscador();
                $('#myModal2').modal('hide');

            }else{
                $('#mensaje_eliminar_proveedor').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#myModal2').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_proveedor').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}

function boton_guardar(){
    // alert( window.id_informe );
    if (window.id_informe != "" ) {
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    

    $('#myModalDescargarBoleta').modal('show');
    $('.boton_modal').css('display','');
}


function guardar_registro(){
    $('.boton_modal').css('display','none');

    if(window.id_informe!=""){
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    var data = $('#formulario_registro').serializeArray();
    data.push({name: 'id_informe',  value: window.id_informe});
    data.push({name: 'id_jugador',  value: window.id_jugador});
    data.push({name: 'nombre_usuario_software', value: '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'});
    
    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/informe_carga_guardar.php",
        type: "post",
        data: data,
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro ingresado correctamente!</h4>');
                boton_volver_serie_selected_registro_cargas_diarias();
                buscador();
                $('#myModalDescargarBoleta').modal('hide');


            }else if(respuesta==2){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro editado correctamente!</h4>');
                boton_volver_serie_selected_registro_cargas_diarias();
                buscador();
                $('#myModalDescargarBoleta').modal('hide');
            }
            else if(respuesta==3){
                $('#mensaje_agregar_DescargarBoleta').html('<h5>Error de conexión: los datos no se han podido insertar.</h5><br>');
            }
            else{ // respuesta==4
                $('#mensaje_agregar_DescargarBoleta').html('<h5>Error de conexión: los datos no se han podido editar: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
}





/*
cuadro_listado_series_registro_cargas_diarias
cuadro_serie_selected_registro_cargas_diarias
cuadro_guardar_informe_cargas_diarias_serie_selected
*/
$(".cuadro_serie").click(function(){

    $("#tabla_ver_informes_todos tbody").empty(); // Vaciando la tabla.

    // alert( sexo  + " - " + serie + " - " + numero_serie );
    $('#cuadro_listado_series_registro_cargas_diarias').hide(500);
    $('#cuadro_serie_selected_registro_cargas_diarias').show(500);
    // $('.cuadro_buscar_buscar').show(500);
    // $('.cuadro_buscar_titulo').show(500);
    // $("#tabla_verEjercicios tbody").empty();

    let sexo = $(this).attr("sexo");
    let serie = $(this).attr("serie");
    let numero_serie = $(this).attr("numero-serie");
    let tecnico = $(this).attr("tecnico");
    $(".titulo_serie").html( serie );
    $(".sexo").val( sexo );
    $(".numero_serie").val( numero_serie );
    $(".tecnico").val( tecnico );

    // Llamando la función 'buscador()'
    buscador(); 

});

    // -------------------- Inicio de la función 'buscador_fecha_inicio_fin()' ------------------------- //
    function buscador() {
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();
     
        
        var inicio = $("#ingresar_inicio").val();
        var fin = $("#ingresar_fin").val();

        if (inicio > fin) {
            inicio = fin;
            fin = $("#ingresar_inicio").val();
        }


        var sexo = $(".sexo").val();
        var numero_serie = $(".numero_serie").val();

        $.ajax({
            url: "post/informe_carga_sexo_serie_ver_todos_fecha_inicio_fin.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
            'sexo': sexo,
            'numero_serie': numero_serie,
            'inicio': inicio,
            'fin': fin          
        },success: function(respuesta){

            var tecnico = $('.tecnico').val();
            // alert( tecnico );
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_ver_informes_todos tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td></td><td></td><td></td><td></td><td><b>No hay informes de carga</b><td></td><td></td><td></td><td></td></td></tr>';
                $("#tabla_ver_informes_todos tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_informe_carga').prop("disabled", true);
            }else{              
                $("#tabla_ver_informes_todos tbody").empty();
                var count = 1;
                for(var i=0; i < respuesta.length; i++){

                    var markup = 
                    '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            <b>#'+count+'</b>\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            <b>' + respuesta[i]['fecha_software'] + '</b>\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            <b>' + 'Sub-' + numero_serie + '</b>\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            <b>' + tecnico + '</b>\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            ' + respuesta[i]['cantidad_total_jugadores_en_informe'] + '/' + respuesta[i]['cantidad_total_jugadores'] + '\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            ' + respuesta[i]['cantidad_total_jugadores_sobre_el_peso'] + '\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            ' + respuesta[i]['cantidad_total_jugadores_peso_normal'] + '\
                        </td>\
                        <td style="padding: 7px;">\
                            <a class="boton_eliminar" onclick="boton_mostrar_modal_descarga();">\
                                <i class="icon-download-alt"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 7px;">\
                            <a class="boton_eliminar" onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                                <i class="icon-pencil"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 7px;">\
                            <a class="boton_eliminar" onClick="boton_eliminar('+respuesta[i]['idinforme_carga']+');">\
                                <i class="icon-remove"></i>\
                            </a>\
                        </td>\
                    </tr>';

                    $("#tabla_ver_informes_todos tbody").append(markup);
                    count = count + 1;
                }
                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar').hide();
            $('#error_conexion').hide();
            $('#sin_resultados').hide();
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
            }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'buscador_fecha_inicio_fin()' ------------------------- //

function boton_volver_cuadro_listado_series_registro_cargas_diarias() {
    $('#cuadro_serie_selected_registro_cargas_diarias').hide(500);
    $('#cuadro_listado_series_registro_cargas_diarias').show(500);
    get_cantidad_jugadores_sexo_serie();
    $('.cuadro_buscar_buscar').show(500);
    $('.cuadro_buscar_titulo').show(500);
    $("#tabla_verEjercicios tbody").empty();
}

function boton_volver_serie_selected_registro_cargas_diarias() {
    $('#cuadro_guardar_informe_cargas_diarias_serie_selected').hide(500);
    $('#cuadro_serie_selected_registro_cargas_diarias').show(500);
    buscador_jugadres_sexo_serie();
}

function chequear_datos(){
    
    var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosEnteros = /[0-9]/;
    flag = true;

    // --------- Validando los selects cuyos atributos 'name' son ingresar_faltas_cometidas_informe_carga[] 
    $("select[name^='ingresar_faltas_cometidas_informe_carga'] option:selected").each(function(){
        let thisValue = $(this).val();
        // alert( thisValue );
        /*
        if( thisValue === "" ) {
            flag = false; 
        } else {
            flag = true;
        }
        */
    });

    // --------- Validando los inputs cuyos atributos 'name' son ingresar_peso_informe_carga[] 
    $("input[name^='ingresar_peso_informe_carga']").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        // alert( thisValue );

        // ------
        if( thisValue != "" ) {
          if( thisValue.match(ER_numericosDecimales) && ( parseInt(thisValue.length) >= 2 && parseInt(thisValue.length) <= 5 ) ){
            
            if( thisValue >= 1 ) {
                thisElement.css("background-color", "#d4ffdc");
            } else {
                thisElement.css("background-color", "#ffc6c6");
                flag = false;                
            }
              
          }else{
              thisElement.css("background-color", "#ffc6c6");
              flag = false;
          }
        } else {
            // thisElement.css("background-color", "white");
            //false: solo si es obligatorio, sacar linea si no es obligatorio el campo
            thisElement.css("background-color", "#d4ffdc");
        }

    }); 

    // --------- Validando los inputs cuyos atributos 'name' son ingresar_peso_ideal_informe_carga[] 
    $("input[name^='ingresar_peso_ideal_informe_carga']").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        // alert( thisValue );

        // ------
        if( thisValue != "" ) {
          if( thisValue.match(ER_numericosDecimales) && ( parseInt(thisValue.length) >= 2 && parseInt(thisValue.length) <= 5 ) ){
              
            if( thisValue >= 1 ) {
                thisElement.css({"background-color": "#28b779", "color": "white"});
            } else {
                thisElement.css({"background-color": "#ffc6c6", "color": "black"});
                flag = false;                
            }

          }else{
              thisElement.css({"background-color": "#ffc6c6", "color": "black"});
              flag = false;
          }
        } else {
            thisElement.css({"background-color": "#28b779", "color": "white"});
            // thisElement.css({"background-color": "#d4ffdc", "color": "black"});
            thisElement.addClass("black-placeholder");
            // thisElement.css("background-color", "white");
            //false: solo si es obligatorio, sacar linea si no es obligatorio el campo
        }
    });     



    if( flag === false ){
        $('#boton_agregar_informe_carga').prop("disabled", true);
    }else{
        $('#boton_agregar_informe_carga').prop("disabled", false);
    }

}



</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.date_fechaNacimiento').datetimepicker({
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

    $('.date_fechaNacimiento').datetimepicker('setDate', new Date() );

    mostrar_al_cargar_pagina();
        //////////////////////////////////////////////////

    for (var i = 0; i <= 10; i++) {
        $(".ingresar_faltas_cometidas_informe_carga").append('<option value="'+i+'">'+i+'</option>');
    }


</script>