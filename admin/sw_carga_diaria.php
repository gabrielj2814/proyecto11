<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{

        include('../bd/informe_carga_BD.php');
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
        $series= ver_series_total();
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
        border: 1px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
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
    
    .boton_gestionar_cargos{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
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
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
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

.agregar_jugadores {
    color: #555555;
    background: #FFCD44;
    border-bottom: 1px solid transparent;
    box-sizing: border-box;
}

.agregar_jugadores:hover {
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
margin:0px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color:<?php echo $color_fondo; ?>; font-size: 12px; margin-bottom:0px;
}

.green-a:hover{
    background-color:<?php echo $color_fondo; ?>;   
}

.green-input {
margin:0px; width:52%; -webkit-appearance: none; -moz-appearance : none; border: 1px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; text-align:center;
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

// Array de Países:
// El penúltimo elemento de cada array representa el tipo de país.
// El último elemento de cada array representa el gentilicio.
var array_paises = [
    [0, 'Todos', ''],
    [1, 'Chile', 'chile.png', 1, 'Chileno'],
    [2, 'Argentina', 'argentina.png', 1, 'Argentino'],
    [3, 'Venezuela', 'venezuela.png', 1, 'Venezolano'],
    [4, 'Brasil', 'brasil.png', 1, 'Brasileño'],
    [5, 'Colombia', 'colombia.png', 1, 'Colombiano'],
    [6, 'Ecuador', 'ecuador.png', 1, 'Ecuatoriano'],
    [7, 'Uruguay', 'uruguay.png', 1, 'Uruguayo'],
    [8, 'Perú', 'peru.png', 1, 'Peruano'],
    [9, 'Paraguay', 'paraguay.png', 'Paraguayo'],
    [10, 'México', 'mexico.png', 1, 'Mexicano'],
    [11, 'España', 'espana.png', 2, 'Español'],
    [12, 'Inglaterra', 'inglaterra.png', 2, 'Inglés'],
    [13, 'Alemania', 'alemania.png', 2, 'Alemán'],
    [14, 'China', 'china.png', 2, 'Chino'],
    [15, 'Bélgica', 'belgica.png', 2, 'Belga'],
    [16, 'Bolivia', 'bolivia.png', 2, 'Boliviano'],
    [17, 'Costa Rica', 'costa_rica.png', 2, 'Costarricense'],
    [18, 'Estados Unidos', 'estados_unidos.png', 2, 'Estadounidense'],
    [19, 'Honduras', 'honduras.png', 2, 'Hondureño'],
    [20, 'El Salvador', 'el_salvador.png', 2, 'Salvadoreño'],
    [21, 'Escocia', 'escocia.png', 2, 'Escocés'],
    [22, 'Francia', 'francia.png', 2, 'Francés'],
    [23, 'Grecia', 'grecia.png', 2, 'Griego'],
    [24, 'Holanda', 'holanda.png', 2, 'Holandés'],
    [25, 'Italia', 'italia.png', 2, 'Italiano'],
    [26, 'Japón', 'japon.png', 2, 'Japonés'],
    [27, 'Portugal', 'portugal.png', 2, 'Portugués'],
    [28, 'Rusia', 'rusia.png', 2, 'Ruso'],
    [29, 'Turquía', 'turquia.png', 2, 'Turco'],
];

var array_categorias = [
    [0, 'Descanso, Ausente o Lesión'],
    [1, 'Suave, carga ligera'],
    [2, 'Regular, Descarga, Readaptador 1'],
    [3, 'Regular, Regenerativo, Readaptador 2, Suplente sin jugar'],
    [4, 'Regular +, Contracciones en velocidad, Carga Mixta, Readaptador 3'],
    [5, 'Fuerte, Contracciones en Tensión, Readaptador Alta'],
    [6, 'Muy Fuerte, Contracciones en duración'],
    [7, 'Partido']
];

/*
var array_categorias = [
    [0, 'Descanso, Ausente o Lesión'],
    [1, 'Suave, carga ligera'],
    [2, 'Regular, Descarga, Readaptador 1'],
    [3, 'Regular, Regenerativo, Readaptador 2, Suplente sin jugar'],
    [4, 'Regular +, Contracciones en velocidad, Carga Mixta, Readaptador 3'],
    [5, 'Fuerte, Contracciones en Tensión, Readaptador Alta'],
    [6, 'Muy Fuerte, Contracciones en duración'],
    [7, 'Partido']
];
*/

var array_posicion = [
    'nulo',
    'Arquero',  
    'Defensa',  
    'Mediocampista',    
];

// Array Posiciones:
// Nota: La posición 2 hace referencia número del grupo de posiciones y el 3 al nombre:
var array_posiciones = [
    [0, 'Todos'],
    [1, 'Arquero', 1, 'Arqueros'],
    [2, 'Defensa Central', 2, 'Defensas'],
    [3, 'Lateral Izquierdo', 2, 'Defensas'],
    [4, 'Lateral Derecho', 2, 'Defensas'],
    [5, 'Volante Defensivo', 3, 'Mediocampistas'],
    [6, 'Volante Izquierdo', 3, 'Mediocampistas'],
    [7, 'Volante Derecho', 3, 'Mediocampistas'],
    [8, 'Volante Mixto', 3, 'Mediocampistas'],
    [9, 'Volante Ofensivo', 3, 'Mediocampistas'],
    [10, 'Extremo Izquierdo', 4, 'Delanteros'],
    [11, 'Extremo Derecho', 4, 'Delanteros'],
    [12, 'Delantero Centro', 4, 'Delanteros'],
];

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
let fechaA = '<?php echo $date_hoy; ?>';

var seriesV2 = <?php echo json_encode($series); ?>;

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
                    <div id="cuadro_listado_series_registro_cargas_diarias" class="row-fluid" style="margin-top: -10px; color: black; font-family: Arial, Helvetica, sans-serif;">
                        <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                            <tr class="sin_fondo">
                                <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 100px; margin-top:5px;"></td>
                                <td>
                                    <center>
                                        <h3 class="titulo_principal">REGISTRO DE CARGAS DIARIAS</h3>
                                        <p style="margin: 0px;">En esta sección puedes crear, visualizar, modifcar y eliminar cargas diarias de cada serie</p>
                                    </center>
                                </td>
                            </tr>
                        </table>

                        <div style="width:100%; background-color:#163D61; height:20px; border-radius: 4px;"></div>

                        <div id="selecciones_cajas" class="row-fluid" style="margin-top: 20px;">
                            <div class="span11 titulo_series" style="margin-top: 30px; margin-left: 0px; margin-bottom: 20px;">
                                <h4 style="text-align: center;">MASCULINA</h4>
                            </div>
                            
                            <?php
                            foreach ($series AS $indice => $valor) {
                                $arreglo_serie = t_serie($indice);
                                if ($arreglo_serie[1] == 1) { $numero_jugadores = informes_por_serie($indice); ?>

                                    <?php  
                                    $sexo = explode('_', $indice, 2)[1]; // Returns This_is_a_string
                                    $numero_serie = strtok( $indice, '_' );
                                    ?>

                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                        <div class="cuadro_serie" numero-serie="<?php echo $numero_serie; ?>" sexo="<?php echo $sexo[0]; ?>" onclick="seleccionSerie('<?php echo $indice; ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> Nº de Informes del mes: <span class="cantidad-informes"><?php echo $numero_jugadores; ?></span> </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            
                            <div class="span11 titulo_series" style="margin-top: 30px; margin-left: 0px; margin-bottom: 20px;">
                                <h4 style="text-align: center;">FEMENINA</h4>
                            </div>
                            
                            <?php
                            foreach ($series AS $indice => $valor) {
                                $arreglo_serie = t_serie($indice);
                                if ($arreglo_serie[1] == 2) { $numero_jugadores = informes_por_serie($indice); ?>

                                    <?php  
                                    $sexo = explode('_', $indice, 2)[1]; // Returns This_is_a_string
                                    $numero_serie = strtok( $indice, '_' );
                                    ?>

                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                        <div class="cuadro_serie" numero-serie="<?php echo $numero_serie; ?>" sexo="<?php echo $sexo[0]; ?>" onclick="seleccionSerie('<?php echo $indice; ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> Nº de Informes del mes: <span class="cantidad-informes"><?php echo $numero_jugadores; ?></span></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>

                    </div>
<!-- ========================================== Fin del id="cuadro_listado_series_registro_cargas_diarias" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_serie_selected_registro_cargas_diarias" ========================================== -->
<div style=" display:none;" id="cuadro_serie_selected_registro_cargas_diarias">

<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
<div class="cuadro_buscar_titulo">

<table style="color: black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                            <tbody><tr class="sin_fondo">
                                <td style="padding: 15px; text-align: center;">
                                    <img src="../config/logo_equipo.png" style="height: 90px;">
                                </td>

      <input class="sexo" type="hidden">
      <input class="numero_serie" type="hidden">
      <input class="tecnico" type="hidden">  

                                <td style="text-align: center;">
                                    <h3 class="titulo_principal" style="margin: 0px; line-height: 26px;">CARGAS DIARIAS</h3>
                                    <p class="titulo_serie" style="margin-top: 10px; font-weight: bold; font-weight: 14px;"></p>
                                </td>
                            </tr>
                        </tbody>
</table>


<div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px; border-radius: 4px;">

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
                                          
                                       <div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar" style="display: block;">
                                        <span style="color:#dc4e4e; display:block;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                        <span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados">Busqueda sin resultados.</span>
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

    <!--
    <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
        <tbody>
            <tr class="sin_fondo">
                <td style="padding: 15px; text-align: center;">
                    <img src="../config/logo_equipo.png" style="height: 90px;">
                </td>                            
                <td style="text-align: center;">
                    <h3 class="titulo_principal"><center>CARGAS DIARIAS</center></h3>
                    <p class="titulo_serie" style="margin-top: 10px; font-weight: bold; font-weight: 14px;"></p>  
                </td>
            </tr>
        </tbody>
    </table>
    -->

    <table style="color: black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
        <tbody>
            <tr class="sin_fondo">
                <td style="padding: 15px; text-align: center;">
                    <img src="../config/logo_equipo.png" style="height: 90px;">
                </td>

                <td style="text-align: center;">
                    <h3 class="titulo_principal" style="margin: 0px; line-height: 26px;">CARGAS DIARIAS</h3>
                    <p class="titulo_serie" style="margin-top: 10px; font-weight: bold; font-weight: 14px;"></p>
                </td>
            </tr>
        </tbody>
    </table>    

    <div class="row-fluid" style="margin: 0px;">
        <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px;">
          <i class="icon-arrow-left"></i> volver
        </button>
    </div>

<br>
</center>   

<div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px; 
border-radius: 4px;">

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
                                       <div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar" style="display: block;">
                                        <span style="color:#dc4e4e; display:block;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                        <span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados">Busqueda sin resultados.</span>
                                       </div>
                                  -->
                                       
                               </center>
                            
                            <div class="row-fluid" style="margin-top:0px;">

                              <button id="boton_buscar_jugador" style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="buscarJugador();"><b style="font-size:13px;"><i class="icon-plus"></i> AGREGAR JUGADOR</b></button>

                            <form method="post" ng-model="formulario_registro" name="formulario_registro" id="formulario_registro" novalidate>

                                <div class="span4" style="display: flex; margin-bottom: 15px;">
                                    <a class="btn btn-md btn-primary green-a">Fecha</a>
                                    <input class="green-input date_fechaNacimiento" id="fecha_informe_carga" name="fecha_informe_carga" readonly="" onchange="chequear_datos();" style="background-color: white;">

                                    <!-- Campo oculto que almacena la fecha de la carga a modificar: -->
                                    <input class="green-input" type="hidden" id="fecha_informe_carga_editar_hidden" name="fecha_informe_carga_editar_hidden" style="background-color: white;">

                                </div>                                

                                <div class="span12" style="margin: 0px;">
                                  <table style="border: 3px solid <?php echo $color_fondo; ?>; width:100%;" id="tabla_ver_informes">
                  
                                        <thead>
                                            <tr>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 140px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 15%;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 30%;"></th>                                                
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: center;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Carga" style="width:100%;">
                                                        PESO
                                                    </div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Peso Ideal" style="width:100%;">
                                                        PESO IDEAL
                                                    </div>
                                                </th>
                                            </tr>

                                        </thead>

                                    <tbody>

            <!--
                <tr style="cursor: pointer;" onclick="// verJugadores();">
                  
                  <td style="padding: 10px;">
                    <center><b>#1</b></center>
                  </td>
                  
                  <td>
                    <center>
                      <img src="../config/chile.png" style="width: 25px;"> <b>Arquero</b>
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
                    <center><input style="margin: 0px; max-height: 32px; height: 26px; width: 100%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="buscar_allo" id="buscar_allo" onchange="buscador();" type="" name="">
                    </center>
                  </td>
                  <td style="width: 200px; padding: 20px;">
                    <center><input style="color: white; margin: 0px; max-height: 26px; height: 32px; width: 100%; -webkit-appearance: none; -moz-appearance: none; background-color: <?php echo $color_fondo; ?>; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="peso_ideal" id="peso_ideal" type="text" placeholder="Ingrese peso ideal">
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
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_registro();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
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

<div id="myModalDescargarExcel" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="boton_aceptar_excel();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>

<div id="myModal2" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_informe();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>


<!-- VIEW JUGADOR -->
<div id="view_ejercicio" class="modal hide" style="border-radius:10px; width: 700px; height: 500px;">

    <div class="modal-header" style="margin-left: 1px; background-color: white; border: white; border-top-right-radius: 5px; border-top-left-radius: 5px;height: 20px">
        <div>

            <hr style="display: inline-block; margin-right: 30px; width: 270px; border: 1px solid #e3e3e3;">
            <img src="../config/logo_equipo.png" style="width:75px; margin-top:5px;">
            
            <hr style="display: inline-block; margin-left: 30px; width: 250px; border: 1px solid #e3e3e3;">
            <h3 style="margin-left: 17px;"><center>CARGA DIARIA</center></h3>

            <!-- <div class="hr-line"></div>
            <fieldset>
                <legend>
                    <img src="../config/logo_equipo.png" style="width:75px; margin-top:5px;">
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
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="guardar_registro();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
      
      
<div id="myModalComentario" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: #28AEB7; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
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
    

                    <!-- -------------------- Inicio del id="modal_buscar_jugador" ------------------------- -->
                    <div id="modal_buscar_jugador" class="modal hide" style="border-radius:10px;">
                        <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
                        </div>
                        
                        <div id="listado_jugadores_modal" class="modal-body"></div>
                        
                        <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                            <button type="button" class="btn btn-default boton_modal" data-dismiss="modal" style="margin-right:20px; border-radius:5px;"><i class="icon-remove"></i> Cerrar</button>
                        </div>
                    </div>
                    <!-- -------------------- Fin del id="modal_buscar_jugador" ------------------------- -->      
      
<!-- -------------------- Inicio del id="modal_validacion_fecha_cargas" ------------------------- -->
<div id="modal_validacion_fecha_cargas" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_validacion_fecha_cargas">
              <h5>No se pueden ingresar 2 informes de cargas diarias el mismo día</h5>
              </div>
            <br>
     </center>
    </div>
    <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
        <button type="button" class="btn btn-default boton_modal" data-dismiss="modal" style="margin-right:20px; border-radius:5px;"><i class="icon-remove"></i> Cerrar</button>
    </div>
</div>
<!-- -------------------- Fin del id="modal_validacion_fecha_cargas" ------------------------- -->

<!-- -------------------- Inicio del id="modal_error_get_fechascarga" ------------------------- -->
<div id="modal_error_get_fechascarga" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_error_get_fechascarga">
              <h5>Ha ocurrido un error al consultar las fechas de cargas diarias</h5>
              </div>
            <br>
     </center>
    </div>
    <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
        <button type="button" class="btn btn-default boton_modal" data-dismiss="modal" style="margin-right:20px; border-radius:5px;"><i class="icon-remove"></i> Cerrar</button>
    </div>
</div>
<!-- -------------------- Fin del id="modal_error_get_fechascarga" ------------------------- -->

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


    // -------------------- Inicio de la función 'get_informes_por_serie()' -------------------- // 
    function get_informes_por_serie(){

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

                $(".cantidad-informes").each(function(i){
                    $(this).html( x[i]['cantidad_informes'] );
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
    // -------------------- Fin de la función 'get_informes_por_serie()' -------------------- //
    // get_informes_por_serie();

    function seleccionSerie (seleccion) {
        
        let serie = seleccion.substring(0, seleccion.indexOf('_'));
        let sexo = seleccion.split("_").pop();

        // alert( 'Serie: ' + serie + '; Sexo: ' + sexo );

        window.id_seleccion = seleccion;

        ////////////////////////////////////////////////////////////
        let nombre_seleccion_titulo = seriesV2[window.id_seleccion];

        
        $("#tabla_ver_informes_todos tbody").empty(); // Vaciando la tabla.

        // alert( sexo  + " - " + serie + " - " + numero_serie );
        $('#cuadro_listado_series_registro_cargas_diarias').hide(500);
        $('#cuadro_serie_selected_registro_cargas_diarias').show(500);
        // $('.cuadro_buscar_buscar').show(500);
        // $('.cuadro_buscar_titulo').show(500);
        // $("#tabla_verEjercicios tbody").empty();

        $(".titulo_serie").html( nombre_seleccion_titulo );
        $(".sexo").val( sexo );
        $(".numero_serie").val( serie );

        var current_date = "<?php echo date('Y-m-d'); ?>";
        $("#ingresar_inicio, #ingresar_fin").val( current_date );

        // Llamando la función 'buscador()'
        buscador(); 
        
    }

    
    /*
    let array_series = [

        // Masculino:
        [1, "SUB-8 Masculina", 8, "Jesús Estrada"],
        [1, "SUB-9 Masculina", 9, "Arturo Medina"],
        [1, "SUB-10 Masculina", 10, "Juan Carrasco"],
        [1, "SUB-11 Masculina", 11, "Fabián Quiroz"],
        
        [1, "SUB-12 Masculina", 12, "Miguel Valenzuela"],
        [1, "SUB-13 Masculina", 13, "Alexis Rivero"],
        [1, "SUB-14 Masculina", 14, "Germán Calderón"],
        [1, "SUB-15 Masculina", 15, "Ernesto Quintero"],
        
        [1, "SUB-16 Masculina", 16, "Pedro Seijas"],
        [1, "SUB-17 Masculina", 17, "Willian Valera"],
        [1, "SUB-19 Masculina", 19, "Carlos Ramírez"],
        [1, "Primer Equipo", 99, "Daniel Páez"],
        
        // Femenino:
        [2, "SUB-15 Femenina", 15, "Manuel Gallardo"],
        [2, "SUB-17 Femenina", 17, "Alejandro Landaeta"],
        [2, "Primer Equipo", 99, "Eduardo Escalona"]

    ];

    for( let i = 0; i < array_series.length; i++ ) {

        let sexo = array_series[i][0];
        let serie = array_series[i][1];
        let numero_serie = array_series[i][2];
        let tecnico = array_series[i][3];

        let cuadro_series =
        '<div class="span3" style="text-align: center; margin: 0px; padding: 10px;">\
            <div sexo="'+sexo+'" serie="'+serie+'" numero-serie="'+numero_serie+'" tecnico="'+tecnico+'" class="cuadro_serie">\
                <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>\
                <div class="nombre_seleccion"><b>'+serie+'</b></div>\
                <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> <span class="cantidad-jugadores" sexo="'+sexo+'"></span> </div>\
            </div>\
        </div>';


        if( sexo === 1 ) {
            $(cuadro_series).appendTo('#btn_series_masculinas');
        } else {
            $(cuadro_series).appendTo('#btn_series_femeninas');
        }

    }
    */

function check_fileds_empty_values() {
    /*
    let array_datos_form = [];
    $("input[name^='ingresar_peso_informe_carga'], input[name^='ingresar_peso_ideal_informe_carga']").each(function(i){
        let thisValue = $(this).val();
        if( thisValue != '' ) {
            array_datos_form[i] = $(this).val();
        }
    });
    console.log( array_datos_form  );
    if( array_datos_form.length === 0 ) {
        $("#boton_agregar_informe_carga").prop("disabled", true);
        // alert("Vacío");
    }    
    */
}

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
                    
                    // $('#boton_agregar_informe_carga').prop("disabled", false); // <--- Habilitando el botón de guardar.

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

                        let nacionalidad1 = respuesta[i]['nacionalidad1'];
                        /*
                        let bandera_nacionalidad;
                        let style_bandera;
                        if( nacionalidad1 === null || nacionalidad1 == '' || nacionalidad1 == '0' ) {
                            bandera_nacionalidad = 'default.png';
                            style_bandera = 'style="width: 25px; height: 25px; position: relative; right: 3px; top: -1px;"';
                        } else {
                            bandera_nacionalidad = array_paises[nacionalidad1][2];
                            style_bandera = 'style="width: 20px; height: 15px;"';
                        }
                        */

                        let posicion = respuesta[i]['posicion'];
                        let nombre_posicion;
                        if( posicion === null || posicion == '' || posicion == '0' || posicion == '999' ) {
                            nombre_posicion = 'No especificado';
                        } else {
                            nombre_posicion = array_posiciones[posicion][1];
                        }

                        var markup = 
                        '<tr class="panel_buscar" style="height:50px;cursor:pointer; color:#555555; font-size:13px;">\
                            <td style="width: 50px;">\
                                <b>#'+count+'</b>\
                            </td>\
                            <td style="width: 300px;">\
                                <input type="hidden" value="'+ respuesta[i]['idfichaJugador'] +'" name="id_ficha_jugador[]" />\
                                <div style="max-width: 150px; text-align: left;">\
                                    <div><p class="ellipsis-text">'+nombre_posicion+'</p></div>\
                                </div>\
                            </td>\
                            <td style="width: 550px">\
                                <div style="max-width: 350px; text-align: left;">\
                                    <div class="img-next-to-text" style="width:10%;"><img src="foto_jugadores/'+respuesta[i]['idfichaJugador']+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"></div>\
                                    <div><p class="ellipsis-text" style="position: relative; top: 3px; left: 7px;">' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</p></div>\
                                </div>\
                            </td>\
                            <td style="width: 350px;">\
                                <center>\
                                <select style="margin: 0px; max-height: 32px; height: 40px; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_faltas_cometidas_informe_carga[]" class="ingresar_faltas_cometidas_informe_carga" onchange="chequear_datos()">\
                                </select>\
                                </center>\
                            </td>\
                            <td style="width: 200px;">\
                                <center><input maxlength="5" style="margin: 0px; max-height: 32px; height: 20px; width: 100px; -webkit-appearance: none; -moz-appearance: none; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_informe_carga[]" id="ingresar_peso_informe_carga_'+i+'" type="text" placeholder="Ej: 12.33" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                                </center>\
                            </td>\
                            <td style="width: 200px;">\
                                <center><input maxlength="5" style="color: white; margin: 0px; max-height: 20px; height: 32px; width: 100px; -webkit-appearance: none; -moz-appearance: none; background-color: <?php echo $color_fondo; ?>; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_ideal_informe_carga[]" id="ingresar_peso_ideal_informe_carga_'+i+'" type="text" placeholder="Ingrese peso ideal" value="' + respuesta[i]['peso_ideal_informe_carga_individual'] + '" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                                </center>\
                            </td>\
                        </tr>';
                        $("#tabla_ver_informes tbody").append(markup);
                        count = count + 1;
                    }
                
                    for (var i = 0; i < array_categorias.length; i++) {
                        $(".ingresar_faltas_cometidas_informe_carga").append('<option value="'+array_categorias[i][0]+'">'+array_categorias[i][1]+'</option>');
                    }

                    // check_fileds_empty_values();

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

    $("#boton_buscar_jugador").hide();

    window.id_informe='';
    $("#tabla_ver_informes tbody").empty();

    var titulo_serie = $(".titulo_serie").html();        
    $(".titulo_serie").html( titulo_serie );
    

    $('#cuadro_serie_selected_registro_cargas_diarias').hide(500);
    $('#cuadro_guardar_informe_cargas_diarias_serie_selected').show(500);
        
    buscador_jugadres_sexo_serie();

    let fecha_actual = "<?php echo date("Y-m-d"); ?>";
    $('#fecha_informe_carga').val( fecha_actual ); // <--- Vaciando input
    $('#fecha_informe_carga_editar_hidden').val( '' ); // <--- Vaciando input

    chequear_datos(); // Validando.
    $('#fecha_informe_carga').css('background-color', 'white');

}
// -------------------------- Fin de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //

// -------------------------- Inicio de la función 'boton_editar_informe_carga( id_informe_carga )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_informe_carga( id_informe_carga ){
    // alert( id_informe_carga );
    var idinforme_carga = id_informe_carga;
    $("#boton_buscar_jugador").show();
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
        },
        success: function(respuesta){
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

                $('#fecha_informe_carga').val( respuesta[0]['fecha_informe_carga'] );
                $('#fecha_informe_carga_editar_hidden').val( respuesta[0]['fecha_informe_carga'] );


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

                    let nacionalidad1 = respuesta[i]['nacionalidad1'];
                    /*
                    let bandera_nacionalidad;
                    let style_bandera;
                    if( nacionalidad1 === null || nacionalidad1 == '' || nacionalidad1 == '0' ) {
                        bandera_nacionalidad = 'default.png';
                        style_bandera = 'style="width: 25px; height: 25px; position: relative; right: 3px; top: -1px;"';
                    } else {
                        bandera_nacionalidad = array_paises[nacionalidad1][2];
                        style_bandera = 'style="width: 20px; height: 15px;"';
                    }
                    */

                    let posicion = respuesta[i]['posicion'];
                    let nombre_posicion;
                    if( posicion === null || posicion == '' || posicion == '0' || posicion == '999' ) {
                        nombre_posicion = 'No especificado';
                    } else {
                        nombre_posicion = array_posiciones[posicion][1];
                    }

                    var markup = 
                    '<tr class="panel_buscar" style="height:50px;cursor:pointer; color:#555555; font-size:13px;">\
                        <td style="width: 50px;">\
                            <b>#'+count+'</b>\
                        </td>\
                        <td style="width: 300px;">\
                            <input class="id_jugador_agregado" type="hidden" value="'+ respuesta[i]['idfichaJugador'] +'" name="id_ficha_jugador[]" />\
                            <input type="hidden" value="'+ respuesta[i]['idinforme_carga_individual'] +'" name="idinforme_carga_individual[]" />\
                            <input type="hidden" value="'+ id_informe_carga +'" name="idinforme_carga[]" />\
                            <div style="max-width: 150px; text-align: left;">\
                                <div><p class="ellipsis-text">'+nombre_posicion+'</p></div>\
                            </div>\
                        </td>\
                        <td style="width: 550px">\
                            <div style="max-width: 350px; text-align: left;">\
                                <div class="img-next-to-text" style="width:10%;"><img src="foto_jugadores/'+respuesta[i]['idfichaJugador']+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"></div>\
                                <div><p class="ellipsis-text" style="position: relative; top: 3px; left: 7px;">' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</p></div>\
                            </div>\
                        </td>\
                        <td style="width: 350px;">\
                            <center>\
                            <select style="margin: 0px; max-height: 32px; height: 40px; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_faltas_cometidas_informe_carga[]" id="ingresar_faltas_cometidas_informe_carga_'+i+'" class="ingresar_faltas_cometidas_informe_carga" onchange="chequear_datos()">\
                            </select>\
                            </center>\
                        </td>\
                        <td style="width: 200px;">\
                            <center><input maxlength="5" style="margin: 0px; max-height: 32px; height: 20px; width: 100px; -webkit-appearance: none; -moz-appearance: none; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_informe_carga[]" id="ingresar_peso_informe_carga_'+i+'" type="text" value="'+respuesta[i]['peso_informe_carga_individual']+'" placeholder="Ej: 12.33" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                            </center>\
                        </td>\
                        <td style="width: 200px;">\
                            <center><input maxlength="5" style="color: white; margin: 0px; max-height: 20px; height: 32px; width: 100px; -webkit-appearance: none; -moz-appearance: none; background-color: <?php echo $color_fondo; ?>; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_ideal_informe_carga[]" id="ingresar_peso_ideal_informe_carga_'+i+'" type="text" placeholder="Ingrese peso ideal" value="'+respuesta[i]['peso_ideal_informe_carga_individual']+'" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                            </center>\
                        </td>\
                    </tr>';
                    $("#tabla_ver_informes tbody").append(markup);
                    count = count + 1;
                }
                
                
                for ( var i = 0; i < array_faltas_cometidas_informe_carga_individual.length; i++ ) {
                    
                    // alert( "Recorrido Nº " + i + ': ' + array_faltas_cometidas_informe_carga_individual[i] );        

                    for (var j = 0; j < array_categorias.length; j++) {
                        // alert(j);
                        if( array_faltas_cometidas_informe_carga_individual[i] == array_categorias[j][0] ) {
                            $("#ingresar_faltas_cometidas_informe_carga_"+i+"").append('<option selected value="'+array_categorias[j][0]+'">'+array_categorias[j][1]+'</option>');
                        } else {
                            $("#ingresar_faltas_cometidas_informe_carga_"+i+"").append('<option value="'+array_categorias[j][0]+'">'+array_categorias[j][1]+'</option>');
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

                // check_fileds_empty_values();

                chequear_datos();


                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar').hide();
            $('#error_conexion').hide();
            $('#sin_resultados').hide();
                
        },
        error: function(){// will fire when timeout is reached
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

    // Consultando fechas de cargas según el sexo y la serie para validar:
    var sexo = $(".sexo").val();
    var numero_serie = $(".numero_serie").val();

    $.ajax({
        url: "post/sw_ver_fechas_informe_carga.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'sexo': sexo,
            'numero_serie': numero_serie
        },
        success: function(respuesta){

            var status;

            if( respuesta != "" ) {

                let fecha_informe_carga = $('#fecha_informe_carga').val();
                let fecha_informe_carga_editar_hidden = $('#fecha_informe_carga_editar_hidden').val();

                let array_fecha_informe_carga = [];
                for(var i=0; i < respuesta.length; i++) {
                    array_fecha_informe_carga[i] = respuesta[i]['fecha_informe_carga'];
                }             

                console.log( array_fecha_informe_carga );

                if( fecha_informe_carga == fecha_informe_carga_editar_hidden ) {
                    status = true;
                } else {
                    let n = array_fecha_informe_carga.includes( fecha_informe_carga );
                    if( n === true ) {
                        $('#fecha_informe_carga').css('background-color', '#ffc6c6');
                        status = false;
                    } else {
                        status = true;
                    }                      
                }

            } 

            // ---------------------------------
            if( status === false ) {
                $('#modal_validacion_fecha_cargas').modal('show'); 
            } else {
                $('#modal_validacion_fecha_cargas').modal('hide'); 
                if (window.id_informe != "" ) {
                    $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
                }else{
                    $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
                }                
                $('#myModalDescargarBoleta').modal('show');
                $('.boton_modal').css('display','');                     
            }       
        
        },error: function(){// will fire when timeout is reached
            $('#modal_error_get_fechascarga').modal('show');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

    


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
/*
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


    var current_date = "<?php echo date('Y-m-d'); ?>";
    $("#ingresar_inicio, #ingresar_fin").val( current_date );

    // Llamando la función 'buscador()'
    buscador(); 

});
*/

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
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="7"><b>No hay informes de carga</b></td></tr>';
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

                    let serie = '';
                    if( numero_serie == '99' ) {
                        serie = 'Primer Equipo';
                    } else {
                        serie = 'Sub-' + numero_serie;
                    }

                    var markup = 
                    '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            <b>#'+count+'</b>\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            <b>' + respuesta[i]['fecha_informe_carga'] + '</b>\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            <b>' + serie + '</b>\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            ' + respuesta[i]['cantidad_total_jugadores_en_informe'] + '/' + respuesta[i]['cantidad_total_jugadores_serie'] + '\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            ' + respuesta[i]['cantidad_total_jugadores_sobre_el_peso'] + '\
                        </td>\
                        <td onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
                            ' + respuesta[i]['cantidad_total_jugadores_peso_normal'] + '\
                        </td>\
                        <td style="padding: 7px;">\
                            <a class="boton_add" onclick="descargarPDF('+respuesta[i]['idinforme_carga']+', '+respuesta[i]['cantidad_total_jugadores_sobre_el_peso']+', '+respuesta[i]['cantidad_total_jugadores_peso_normal']+');">\
                                <i class="icon-download-alt"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 7px;">\
                            <a class="boton_editar" onClick="boton_editar_informe_carga('+respuesta[i]['idinforme_carga']+');">\
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

    // -------------------- Inicio de la función 'buscarJugador()' ------------------------- //
    function buscarJugador() {
        $('#modal_buscar_jugador').modal();
        $('#listado_jugadores_modal').html('<div style="text-align: center;"><h5 style="margin: 0px 0px 20px;"><i class="icon-spinner icon-spin icon-large"></i> Cargando jugadores...</h5><img src="../config/ver_archivo_jugador.png"></div>');
        
        var sexo = $(".sexo").val();
        var numero_serie = $(".numero_serie").val();

        $.ajax({
            url: "post/serie_ver.php",
            type: "post",
            dataType: 'json',
            data: {
                'sexo': sexo,
                'numero_serie': numero_serie
            },success: function(respuesta){
                $('#listado_jugadores_modal').empty();
                if(respuesta != ""){
                    window.jugadores_scouting = respuesta;
                    for(var j = 0; j < window.jugadores_scouting.length; j++){
                        let estatusAgregar = true;
                        $('.id_jugador_agregado').each(function () {
                            if ($(this).val() == window.jugadores_scouting[j]['idfichaJugador']) {
                                estatusAgregar = false;
                            }
                        });
                        
                        if (estatusAgregar){
                            let year    = window.jugadores_scouting[j]['fechaNacimiento'].substr(0,4);
                            let month   = window.jugadores_scouting[j]['fechaNacimiento'].substr(5,2);
                            let day     = window.jugadores_scouting[j]['fechaNacimiento'].substr(8,2);
                            let yearA   = fechaA.substr(0,4);
                            let monthA  = fechaA.substr(5,2);
                            let dayA    = fechaA.substr(8,2);
                            
                            let edad = 0;
                            if (year != '' && year != undefined) {
                                if (year <= yearA) {
                                    edad = yearA - year;
                                    if (month > monthA) {
                                        if (edad != 0) 
                                            edad--;
                                    } else if (month == monthA) {
                                        if (day > dayA)
                                            if (edad != 0) 
                                                edad--;
                                    }
                                }
                            }

                            // alert( 'Edad: ' + edad + '. Tipo de dato: ' + typeof edad );

                            if( edad === 0 || edad === 1 ) {
                                edad = edad + ' Año';
                            } else {
                                edad = edad + ' Años';
                            }

                            let posicion = window.jugadores_scouting[j]['posicion'];
                            let nombre_posicion;
                            if( posicion === null || posicion == '' || posicion == '0' || posicion == '999' ) {
                                nombre_posicion = 'No especificado';
                            } else {
                                nombre_posicion = array_posiciones[posicion][1];
                            }                            
                            
                            $('#listado_jugadores_modal').append('<div class="agregar_jugadores" style="display: flex; align-items: center; width: 100%; padding: 3px 5px;" onclick="agregarJugador('+j+');"><b style="width: 100%;">'+nombre_posicion+' <img src="foto_jugadores/'+window.jugadores_scouting[j]['idfichaJugador']+'.png" style="width: 25px; border: 2px solid #555555; border-radius: 50%; margin: 0px 5px;">'+window.jugadores_scouting[j]['nombre']+' '+window.jugadores_scouting[j]['apellido1']+' '+window.jugadores_scouting[j]['apellido2']+', '+edad+'</b></div>');
                        }
                    }
                    
                    if ($('#listado_jugadores_modal').html() == '')
                        $('#listado_jugadores_modal').append('<div style="text-align: center;"><b>No hay jugadores por agregar</b></div>');
                }else{
                    $('#listado_jugadores_modal').html('<div style="text-align: center;"><h5 style="margin: 0px 0px 20px;"><i class="icon-remove"></i> No hay jugadores disponibles</h5><img src="../config/ver_archivo_jugador.png"></div>');
                }
            },error: function(){
                $('#listado_jugadores_modal').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
                setTimeout(function () {
                    $('#modal_buscar_jugador').modal('hide');
                }, 2000);
            }, timeout: 15000
        });
    }
    // -------------------- Fin de la función 'buscarJugador()' ------------------------- //
    
    // -------------------- Inicio de la función 'agregarJugador()' ------------------------- //
    function agregarJugador(n_posicion) {
        $('#modal_buscar_jugador').modal('hide');
        
        var count = $('#tabla_registros_'+window.vista_v+' tbody tr').length + 1;
        var count2 = $('#tabla_registros_'+window.vista_v+' tbody tr').length;
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        let markup = '';
        let idfichaJugador = window.jugadores_scouting[n_posicion]['idfichaJugador']; 
        let nombre = window.jugadores_scouting[n_posicion]['nombre']; 
        let apellido1 = window.jugadores_scouting[n_posicion]['apellido1'];
        let apellido2 = window.jugadores_scouting[n_posicion]['apellido2']; 
        let year    = window.jugadores_scouting[n_posicion]['fechaNacimiento'].substr(0,4);
        let month   = window.jugadores_scouting[n_posicion]['fechaNacimiento'].substr(5,2);
        let day     = window.jugadores_scouting[n_posicion]['fechaNacimiento'].substr(8,2);
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        

        let posicion = window.jugadores_scouting[n_posicion]['posicion'];
        let nombre_posicion;
        if( posicion === null || posicion == '' || posicion == '0' || posicion == '999' ) {
            nombre_posicion = 'No especificado';
        } else {
            nombre_posicion = array_posiciones[posicion][1];
        }

                    markup = 
                    '<tr class="panel_buscar" style="height:50px;cursor:pointer; color:#555555; font-size:13px;">\
                        <td style="width: 50px;">\
                            <b>#'+count+'</b>\
                        </td>\
                        <td style="width: 300px;">\
                            <input class="id_jugador_agregado" type="hidden" value="'+ idfichaJugador +'" name="id_jugador_agregado[]" />\
                            <b>'+nombre_posicion+'</b>\
                        </td>\
                        <td style="width: 550px">\
                            <img src="foto_jugadores/'+idfichaJugador+'.png" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"> \
                            <b>' + nombre + ' ' + apellido1 + ' ' + apellido2 + '</b>\
                        </td>\
                        <td style="width: 350px;">\
                            <center>\
                            <select style="margin: 0px; max-height: 32px; height: 40px; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_faltas_cometidas_informe_carga_ja[]" id="ingresar_faltas_cometidas_informe_carga_ja'+n_posicion+'" class="ingresar_faltas_cometidas_informe_carga" onchange="chequear_datos()">\
                            </select>\
                            </center>\
                        </td>\
                        <td style="width: 200px;">\
                            <center><input maxlength="5" style="margin: 0px; max-height: 32px; height: 20px; width: 100px; -webkit-appearance: none; -moz-appearance: none; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_informe_carga_ja[]" id="ingresar_peso_informe_carga_ja'+n_posicion+'" type="text" value="" placeholder="Ej: 12.33" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                            </center>\
                        </td>\
                        <td style="width: 200px;">\
                            <center><input maxlength="5" style="color: white; margin: 0px; max-height: 20px; height: 32px; width: 100px; -webkit-appearance: none; -moz-appearance: none; background-color: <?php echo $color_fondo; ?>; border: 2px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="ingresar_peso_ideal_informe_carga_ja[]" id="ingresar_peso_ideal_informe_carga_ja'+n_posicion+'" type="text" placeholder="Ingrese peso ideal" value="" onkeydown="chequear_datos()" onkeyup="chequear_datos()">\
                            </center>\
                        </td>\
                    </tr>';
                    $("#tabla_ver_informes tbody").append(markup);

                    for (var i = 0; i < array_categorias.length; i++) {
                        $(".ingresar_faltas_cometidas_informe_carga").append('<option value="'+array_categorias[i][0]+'">'+array_categorias[i][1]+'</option>');
                    }

                    check_fileds_empty_values();                    
                    
                    let contador = 1;
                    $("#tabla_ver_informes tbody .panel_buscar").each(function(){
                        $(this).find('td').eq(0).html( '<b>#'+contador+'</b>' );
                        contador++;
                    });                  

    }
    // -------------------- Fin de la función 'agregarJugador()' ------------------------- //


function boton_volver_cuadro_listado_series_registro_cargas_diarias() {
    get_informes_por_serie();
    $('#cuadro_serie_selected_registro_cargas_diarias').hide(500);
    $('#cuadro_listado_series_registro_cargas_diarias').show(500);
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
    
    var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,2})?$/;
    var ER_numericosEnteros = /[0-9]/;
    
    flag = true;
    

    // ------------------------------------------------------------------------ //
    let fecha_informe_carga = $("#fecha_informe_carga").val();
    if( fecha_informe_carga == "" ) {
        $("#fecha_informe_carga").css("background-color", "white"); // <--- Color blanco.
        // flag = false;
    } else {
        $("#fecha_informe_carga").css("background-color", "white");
    }    

    var array_datos_form = [];

    $("input[name^='ingresar_peso_informe_carga'], input[name^='ingresar_peso_ideal_informe_carga']").each(function(i){
        let thisValue = $(this).val();
        if( thisValue != '' ) {
            array_datos_form[i] = $(this).val();
        }
    });
    console.log( array_datos_form );
    /*
    if( array_datos_form.length === 0 ) {
        flag = false;
    }
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
        
    });
    */
    
    // --------- Validando los inputs cuyos atributos 'name' son ingresar_peso_informe_carga[] 
    $("input[name^='ingresar_peso_informe_carga']").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        let lengthValue = parseInt( thisValue.length ); 
        // if( thisValue != '' && lengthValue >= 1 ) {
        if( thisValue != '' && lengthValue >= 1 ) {   
          
            // Validando enteros
            if( lengthValue >= 1  ) {
                
                if( thisValue.charAt(0) == '0' ) {
                    thisElement.css("background-color", "#ffc6c6");
                    flag = false;         
                } else {

                    if( ER_numericosDecimales.test( thisValue ) && lengthValue <= 2  ) {
                        ER_numericosDecimales = /[1-9]/;
                        thisElement.css("background-color", "white");
                    } else {
                      if( thisValue.charAt(2) == '.' || thisValue.charAt(2) == ',' ) {
                        ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,2})?$/;
                        if( ER_numericosDecimales.test( thisValue ) && lengthValue <= 5  ) {
                            thisElement.css("background-color", "white");
                        } else {
                            thisElement.css("background-color", "#ffc6c6");
                            flag = false;         
                        }                   
                      } else {
                            thisElement.css("background-color", "#ffc6c6");
                            flag = false;    
                      }
         
                    }

                }

            } else {
                thisElement.css("background-color", "white");    
            }      
          
        } else {
            // flag = false;
            thisElement.css("background-color", "white");
        }

    }); 

    // --------- Validando los inputs cuyos atributos 'name' son ingresar_peso_ideal_informe_carga[] 
    $("input[name^='ingresar_peso_ideal_informe_carga']").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        let lengthValue = parseInt( thisValue.length );
        // if( thisValue != '' && lengthValue >= 1 ) {
        if( thisValue != '' && lengthValue >= 1 ) {   
          
            // Validando enteros
            if( lengthValue >= 1  ) {

                if( thisValue.charAt(0) == '0' ) {
                    thisElement.css("background-color", "#ffc6c6");
                    flag = false;         
                } else {

                    if( ER_numericosDecimales.test( thisValue ) && lengthValue <= 2  ) {
                        ER_numericosDecimales = /[1-9]/;
                        thisElement.css({"background-color": "<?php echo $color_fondo; ?>;", "color": "white"});
                    } else {
                      if( thisValue.charAt(2) == '.' || thisValue.charAt(2) == ',' ) {
                        ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,2})?$/;
                        if( ER_numericosDecimales.test( thisValue ) && lengthValue <= 5  ) {
                            thisElement.css({"background-color": "<?php echo $color_fondo; ?>;", "color": "white"});
                        } else {
                            thisElement.css({"background-color": "#ffc6c6", "color": "black"});
                            flag = false;         
                        }                   
                      } else {
                            thisElement.css({"background-color": "#ffc6c6", "color": "black"});
                            flag = false;    
                      }
         
                    }

                }               

            } else {
                thisElement.css("background-color", "white"); 
            }      
          
        } else {
            let color_fondo = "<?php echo substr($color_fondo, 0, -1); ?>"
            thisElement.css({"background-color": " "+color_fondo+" ", "color": "white"});
            // thisElement.css({"background-color": "white", "color": "black"});
            thisElement.addClass("black-placeholder");            
            // flag = false;
            console.log('s');
        }
    });   



    if( flag === false ){
        $('#boton_agregar_informe_carga').prop("disabled", true);
    }else{
        $('#boton_agregar_informe_carga').prop("disabled", false);
    }

}

function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

// --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
function descargarPDF( idinforme_carga, cantidad_total_jugadores_sobre_el_peso, cantidad_total_jugadores_peso_normal ){

console.log("ID Informe: " + idinforme_carga + "; Jugadores sobre el peso: " + cantidad_total_jugadores_sobre_el_peso + "; Jugadores con peso normal: " + cantidad_total_jugadores_peso_normal );

$("#descargarPDF").modal('show');
$('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');

    $.ajax({
        url: "post/reportes/generarPDF_informe_carga.php",
        type: "post",
        data: {
            idinforme_carga,
            cantidad_total_jugadores_sobre_el_peso,
            cantidad_total_jugadores_peso_normal            
        },
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            if(respuesta != ''){
                $('#mensaje_agregar_descargarPDF').html('<h5>PDF Generado Exitosamente...</h5><br><button type="submit" class="boton_informe_jugador" style="border-radius: 5px" id="boton_agregar_informe" ><a  class="btn_descargar" onClick="closeModal_pdf();" download href="reportes_pdf/'+respuesta+'">DESCARGAR PDF</a></button>');
            }else{
                $('#mensaje_agregar_descargarPDF').html('<h5>Error de conexión: los datos no se han podido insertar.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_descargarPDF').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
// }, 1500);

}
// --------------------------------------- Fin de la función descargarPDF() --------------------------------------- // 

// --------------------------------------- Inicio de la función descargarPDFTwo() --------------------------------------- //
function descargarPDFTwo(linea){
$("#descargarPDF").modal('show');
$('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
        
        var namename = window.jugadores_scouting[linea]['nombre_paciente']+' '+window.jugadores_scouting[linea]['apellido_paciente'];
        var idpacientee = window.jugadores_scouting[linea]['idpaciente_kine'];

        var data = [];
        data.push({name: 'idjugador', value: idpacientee});
        data.push({name: 'nombre',  value: namename});

    $.ajax({
        url: "post/reportes/generarPDF_tratamientoTwo.php",
        type: "post",
        data: data,
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            if(respuesta != ''){
                // alert(JSON.stringify(respuesta));
                $('#mensaje_agregar_descargarPDF').html('<h5>PDF Generado Exitosamente...</h5><br><button type="submit" class="boton_informe_jugador" style="border-radius: 5px" onclick="downloadPDF()" id="boton_agregar_informe" ><a  class="btn_descargar" onClick="closeModal_pdf();" download href="reportes_pdf/'+respuesta+'">DESCARGAR PDF</a></button>');
            }else{
                $('#mensaje_agregar_descargarPDF').html('<h5>Error de conexión: los datos no se han podido insertar.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_descargarPDF').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
// }, 1500);

}
// --------------------------------------- Fin de la función descargarPDFTwo() --------------------------------------- // 
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

                    for (var i = 0; i < array_categorias.length; i++) {
                        $(".ingresar_faltas_cometidas_informe_carga").append('<option value="'+array_categorias[i][0]+'">'+array_categorias[i][1]+'</option>');
                    }


</script>