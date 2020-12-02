<?PHP
function registrarContextoIncidenteControlador($POST){
    include("../../bd/atencion_diaria_BD.php");
    return registrarContextoIncidente($POST);
}
?>