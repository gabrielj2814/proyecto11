<?PHP
function registrarContextoIncidenteControlador($POST){
    include("../../bd/atencion_diaria_federacion_BD.php");
    return registrarContextoIncidente($POST);
}
?>