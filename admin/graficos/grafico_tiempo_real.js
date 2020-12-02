function obtener_monitoreo_sensores(green){
	var mje="No";
	$.ajax({
		url: URL_DATOS_GREEN,
		type: 'GET',
		data: 'green='+green,
		contentType: "application/json",
        dataType: "json",
		success: function(respuesta) {
			mje="si";
		},
		//cache: false
	});
	return mje;
}

Highcharts.setOptions({
	lang: {
		months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		weekdays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',  'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
	}
});

function requestData(){
	$.ajax({
		url: URL_DATOS,
		type: 'GET',
		data: 'green='+GREEN_SELECCIONADO,
		contentType: "application/json",
        dataType: "json",
		success: function(points){
				var temperatura=points['temperatura'];
				var humedad=points['humedad'];
				//if(temperatura.length > 0){
				if(window.inicio==1){ //se cargan los datos
					if(temperatura.length!=0){
						window.inicio=0;
						chart.series[1].setData(eval(temperatura));
						window.fecha_punto_anterior=temperatura[0];
					}
					if(humedad.length!=0){
						window.inicio=0;
						chart.series[0].setData(eval(humedad));
						window.fecha_punto_anterior=humedad[0];
					}
				}else{   //se agrega punto final
					if(eval(humedad[humedad.length-1][0])!=window.fecha_punto_anterior){
						var series = chart.series[1], shift = series.data.length > NUMERO_DE_PUNTOS; //shift
						if(temperatura.length!=0){
							chart.series[1].addPoint(eval(temperatura[temperatura.length-1]), false, shift);
							window.fecha_punto_anterior=temperatura[temperatura.length-1][0];
						}
						if(humedad.length!=0){
							chart.series[0].addPoint(eval(humedad[humedad.length-1]), true, shift);
							window.fecha_punto_anterior=humedad[humedad.length-1][0];
						}
					}	
				}
				setTimeout(requestData, 1000);
		},
		cache: false
	});
}

function cambiar_grafico(){
	$.ajax({
		url: URL_DATOS,
		type: 'GET',
		data: 'green='+GREEN_SELECCIONADO,
		contentType: "application/json",
        dataType: "json",
		success: function(points) {
			var temp=points['temperatura'];
            var hum=points['humedad'];
			window.inicio=1;
			chart.series[0].setData(eval(hum));
			chart.series[1].setData(eval(temp));
			/*
			if(hum.length!=0){
				window.fecha_punto_anterior=hum[0];
				window.inicio=1;
				//chart.series[0].setData(eval(hum));
			}else{
				window.inicio=1;
				
			}
			
			*/
			//chart.series[0].setData(eval(hum));
			//chart.series[1].setData(eval(temp));
			//chart.series[0].setData(eval(hum));
			
			//inicio=0;
			//fecha_punto_anterior=hum[0];
			//chart.series[1].setData(eval(temp));
			//chart.series[0].setData(eval(hum));
			
		},
		cache: false
	});
	return eval(points);
}

	
$(document).ready(function() {

	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'spline',
			//defaultSeriesType: 'line',
			backgroundColor: null,
			events: {
				load: requestData
			}
		},
		title: {
			text: null
		},
		exporting: { 
			enabled: false,
			buttons: {
                contextButton: {
					color: '#0890ef',
                    symbolFill: '#28b779',
                    symbolStroke: '#28b779'
                }
            }
		},
		subtitle: {
			text: null
		},
		credits: {
			enabled: false
		},
		xAxis: {
			type: 'datetime',
			tickPixelInterval: 150,
			maxZoom: 20 * 1000,
			title: {
				text: 'Linea de tiempo en horas'
			}

		},
		yAxis: {
			min: 0,
			max: 100,
			minPadding: 0.2,
			maxPadding: 0.2,
			title: {
				text: 'Temperatura [ºC]',
				enabled: false
			}
		},
		tooltip: {
			shared: true,
        	useHTML: true,
			borderColor: '#28b779',
			borderWidth: 2,
			borderRadius: 5,
			crosshairs: true,
			followTouchMove: true,
			pointFormat: '<b>Promedio {series.name}: </b>  {point.y}</br>',
			valueDecimals: 1
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true
			}
		},
		series: [{
			showInLegend: false,   
			color: '#68cfe8',
			name: 'Humedad',
			type: 'areaspline',
			tooltip: {
                valueSuffix: ' [%]'
            },
			data: []
		},{
			showInLegend: false,   
			color: '#d93a49',
			name: 'Temperatura',
			tooltip: {
                valueSuffix: ' [ºC]'
            },
			data: []
			
		}],
    lang: {
        noData: "No hay mediciones"
    },
    noData: {
        style: {
            fontWeight: 'bold',
            fontSize: '15px',
            color: '#303030'
        }
    }
	});
	

});

