<html lang="es" ng-app="App_Angular">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script type="text/javascript" src="../../graficos/jquery-3.1.1.min.js"></script>
<style>
.boton_enviar{
	width:100%; 
	height:30px; 
	cursor:pointer; 
	border-radius:5px;
	background-color:#28b779;
	color:white;
}

.boton_enviar:HOVER{
	width:100%; 
	height:30px; 
	cursor:pointer; 
	border-radius:5px;
	background-color:#76b99c;
	color:white;
}

.boton_borrar{
	width:100px; 
	cursor:pointer; 
	border-radius:5px;
	background-color:#28b779;
	color:white;
}

.boton_borrar:HOVER{
	width:100px; 
	cursor:pointer; 
	border-radius:5px;
	background-color:#76b99c;
	color:white;
}

</style>

<script>

/////////// Sin saltos de linea ////////////
$(".codigo_html").keypress(function (e) {
    if (e.keyCode != 13) return;
    var msg = $("#area").val().replace(/\n/g, "");
    if (!util.isBlank(msg))
    {
        send(msg);
        $("#area").val("");
    }
    return false;
});
///////////////////////////////////////////

$( "#success" ).load( "../../prueba_grafico_imagen.php", function( response, status, xhr ) {
  if ( status == "error" ) {
    var msg = "Sorry but there was an error: ";
    $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
  }
});

function borrar_todo(){
	$('.codigo_html').val('');
}

</script>
</head>
<body>
<center>
<h2>PDF-TATOR 3000</h2><br>
<div style="width:70%; margin-top:-20px;">
<button style="float:right; margin-bottom:5px;" class="boton_borrar" onClick="borrar_todo();">BORRAR TODO</button>
<form target="_blank" action="generarPDF.php" method="POST" id="form">
<textarea class="codigo_html" name="codigo_html" style="width:100%; height:400px; padding:5px; border: 8px solid #28b779; border-radius:6px; color:white; background-color:black;" placeholder="Pega aqui eL codigo HTML..."></textarea><br />
<h5><input type="submit" class="boton_enviar" value="CREAR PDF!"></h5>
</form>
</div>
<div id="success"></div>
<div id="error"></div>
</center>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><embed src="audio.mp3" autostart=false loop=false>

</body>
</html>