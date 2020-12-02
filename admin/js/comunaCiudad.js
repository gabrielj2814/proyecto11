// JavaScript Document



function obtener_distancia_region(mismaComuna, comuna, lugar){// mismaComuna=0 ptra comuna, comuna=1 misma comuna
	var distancia = 0;
	if(mismaComuna==0){ //otra comuna
		if(comuna==0){//Elige una Region
			distancia = 0;
		}else if(comuna==1){//Antofagasta
			distancia = 1392;
		}else if(comuna==2){//Arica y Parinacota
			distancia = 2126;
		}else if(comuna==3){//Atacama
			distancia = 973;
		}else if(comuna==4){//Aisén
			distancia = 0;
		}else if(comuna==5){//Bio Bio
			distancia = 584;
		}else if(comuna==6){//Coquimbo
			distancia = 368;
		}else if(comuna==7){//La Araucanía
			distancia = 843;
		}else if(comuna==8){//Libertador BO
			distancia = 263;
		}else if(comuna==9){//Los Lagos
			distancia = 965;
		}else if(comuna==10){//Los Ríos
			distancia = 1070;
		}else if(comuna==11){//Magallanes
			distancia = 0;
		}else if(comuna==12){//Maule
			distancia = 389;
		}else if(comuna==13){//Metropolitana
			distancia = 125;
		}else if(comuna==14){//Tarapacá
			distancia = 1726;
		}else if(comuna==15){//Valparaíso
			distancia = 0;
		}	
	
	
	}else{ //misma comuna
	
		if(lugar=='Algarrobo'){
			distancia = 105;
		}else if(lugar=='Cabildo'){
			distancia = 79;
		}else if(lugar=='Casablanca'){
			distancia = 65.8;
		}else if(lugar=='Catemu'){
			distancia = 86.6;
		}else if(lugar=='Con Con'){
			distancia = 30.5;
		}else if(lugar=='El Tabo'){
			distancia = 113;
		}else if(lugar=='Hijuelas'){
			distancia = 19.2;
		}else if(lugar=='Isla De Pascua'){
			distancia = 0;
		}else if(lugar=='Isla Negra'){
			distancia = 109;
		}else if(lugar=='La Ligua'){
			distancia = 58.8;
		}else if(lugar=='La Calera'){
			distancia = 13.8;
		}else if(lugar=='La Cruz'){
			distancia = 8;
		}else if(lugar=='Limache'){
			distancia = 18.1;
		}else if(lugar=='Llay Llay'){
			distancia = 40.1;
		}else if(lugar=='Los Andes'){
			distancia = 84.8;
		}else if(lugar=='Nogales'){
			distancia = 23.5;
		}else if(lugar=='Olmue'){
			distancia = 22.9;
		}else if(lugar=='Panquehue'){
			distancia = 55.4;
		}else if(lugar=='Papudo'){
			distancia = 75.1;
		}else if(lugar=='Petorca'){
			distancia = 111;
		}else if(lugar=='Puchuncavi'){
			distancia = 55.7;
		}else if(lugar=='Putaendo'){
			distancia = 81.9;
		}else if(lugar=='Quillota'){
			distancia = 0;
		}else if(lugar=='Quilpue'){
			distancia = 37.1;
		}else if(lugar=='Quintero'){
			distancia = 47.7;
		}else if(lugar=='San Antonio'){
			distancia = 116;
		}else if(lugar=='San Felipe'){
			distancia = 68.4;
		}else if(lugar=='Santa Maria'){
			distancia = 77.5;
		}else if(lugar=='Valparaiso'){
			distancia = 54.8;
		}else if(lugar=='Villa Alemana'){
			distancia = 32.4;
		}else if(lugar=='Viña Del Mar'){
			distancia = 49;
		}else if(lugar=='Zapallar'){
			distancia = 73.5;
		}
	
	}
	return distancia;
}


function cargarCiudad(valor) { 
	  valor = parseInt(valor);
	  var arrayValores=new Array( 
		  new Array(1,"Antofagasta","Antofagasta"),          //Antofagasta
		  new Array(1,"Calama","Calama"), 
		  new Array(1,"Maria Elena","Maria Elena"), 
		  new Array(1,"Mejillones","Mejillones"), 
		  new Array(1,"Ollague","Ollague"), 
		  new Array(1,"San Pedro de Atacama","San Pedro de Atacama"), 
		  new Array(1,"Sierra Gorda","Sierra Gorda"), 
		  new Array(1,"Tal Tal","Tal Tal"), 
		  new Array(1,"Tocopilla","Tocopilla"),
		  
		  new Array(2,"Arica","Arica"),              //Arica
		  new Array(2,"Camarones","Camarones"), 
		  new Array(2,"General Lagos","General Lagos"), 
		  new Array(2,"Putre","Putre"), 
		  
		  new Array(3,"Alto del Carmen","Alto del Carmen"),    //Atacama
		  new Array(3,"Caldera","Caldera"),          
		  new Array(3,"Chañaral","Chañaral"), 
		  new Array(3,"Copiapó","Copiapó"), 
		  new Array(3,"Diego de Almagro","Diego de Almagro"), 
		  new Array(3,"Freirina","Freirina"),
		  new Array(3,"Huasco","Huasco"), 
		  new Array(3,"Tierra Amarilla","Tierra Amarilla"), 
		  new Array(3,"Vallenar","Vallenar"),
		  
		  new Array(4,"Aysen","Aysen"),             //Aysen
		  new Array(4,"Chile Chico","Chile Chico"), 
		  new Array(4,"Cisnes","Cisnes"),
		  new Array(4,"Cochrane","Cochrane"), 
		  new Array(4,"Coyhaique","Coyhaique"), 
		  new Array(4,"Guaitecas","Guaitecas"),
		  new Array(4,"Lago Verde","Lago Verde"), 
		  new Array(4,"O'Higgins","O'Higgins"), 
		  new Array(4,"Rio Ibanez","Rio Ibanez"),
		  new Array(4,"Tortel","Tortel"), 
		  
		  new Array(5,"Alto Biobio","Alto Biobio"),             //Bio Bio
		  new Array(5,"Antuco","Antuco"), 
		  new Array(5,"Arauco","Arauco"),
		  new Array(5,"Bulnes","Bulnes"), 
		  new Array(5,"Cabrero","Cabrero"), 
		  new Array(5,"Cañete","Cañete"),
		  new Array(5,"Chiguayante","Chiguayante"), 
		  new Array(5,"Chillan","Chillan"), 
		  new Array(5,"Chillan Viejo","Chillan Viejo"),
		  new Array(5,"Cobquecura","Cobquecura"), 
		  new Array(5,"Coelemu","Coelemu"), 
		  new Array(5,"Coihueco","Coihueco"), 
		  new Array(5,"Concepcion","Concepcion"),
		  new Array(5,"Contulmo","Contulmo"), 
		  new Array(5,"Coronel","Coronel"), 
		  new Array(5,"Curanilahue","Curanilahue"),
		  new Array(5,"El Carmen","El Carmen"), 
		  new Array(5,"Florida","Florida"), 
		  new Array(5,"Hualpen","Hualpen"),
		  new Array(5,"Hualqui","Hualqui"),
		  new Array(5,"Laja","Laja"), 
		  new Array(5,"Lebu","Lebu"), 
		  new Array(5,"Los Alamos","Los Alamos"), 
		  new Array(5,"Los Angeles","Los Angeles"), 
		  new Array(5,"Lota","Lota"), 
		  new Array(5,"Mulchen","Mulchen"), 
		  new Array(5,"Nacimiento","Nacimiento"), 
		  new Array(5,"Negrete","Negrete"), 
		  new Array(5,"Ninhue","Ninhue"),	  
		  new Array(5,"Pemuco","Pemuco"),
		  new Array(5,"Penco","Penco"), 
		  new Array(5,"Pinto","Pinto"), 
		  new Array(5,"Portezuelo","Portezuelo"), 
		  new Array(5,"Quilaco","Quilaco"), 
		  new Array(5,"Quilleco","Quilleco"), 
		  new Array(5,"Quillon","Quillon"), 
		  new Array(5,"Quirihue","Quirihue"), 
		  new Array(5,"Ranquil","Ranquil"), 
		  new Array(5,"San Carlos","San Carlos"),     
		  new Array(5,"San Fabian","San Fabian"),
		  new Array(5,"San Ignacio","San Ignacio"), 
		  new Array(5,"San Nicolas","San Nicolas"), 
		  new Array(5,"San Pedro De La Paz","San Pedro De La Paz"), 
		  new Array(5,"San Rosendo","San Rosendo"), 
		  new Array(5,"Santa Barbara","Santa Barbara"), 
		  new Array(5,"Santa Juana","Santa Juana"), 
		  new Array(5,"Talcahuano","Talcahuano"), 
		  new Array(5,"Tirua","Tirua"), 
		  new Array(5,"Tome","Tome"), 
		  new Array(5,"Trehuaco","Trehuaco"),
		  new Array(5,"Tucapel","Tucapel"), 
		  new Array(5,"Yumbel","Yumbel"), 
		  new Array(5,"Yungay","Yungay"), 
		  new Array(5,"Ñiquen","Ñiquen"), 
		  
		  new Array(6,"Andacollo","Andacollo"),      //Coquimbo
		  new Array(6,"Combarbala","Combarbala"), 
		  new Array(6,"Coquimbo","Coquimbo"), 
		  new Array(6,"Illapel","Illapel"), 
		  new Array(6,"La Higuera","La Higuera"),	  
		  new Array(6,"La Serena","La Serena"),
		  new Array(6,"Los Vilos","Los Vilos"), 
		  new Array(6,"Monte Patria","Monte Patria"), 
		  new Array(6,"Ovalle","Ovalle"), 
		  new Array(6,"Paihuano","Paihuano"), 
		  new Array(6,"Punitaqui","Punitaqui"), 
		  new Array(6,"Salamanca","Salamanca"), 
		  new Array(6,"Vicuña","Vicuña"), 
		  
		  new Array(7,"Angol","Angol"),      //La Araucania
		  new Array(7,"Carahue","Carahue"),
		  new Array(7,"Cholchol","Cholchol"),
		  new Array(7,"Collipulli","Collipulli"), 
		  new Array(7,"Cunco","Cunco"), 
		  new Array(7,"Curacautin","Curacautin"), 
		  new Array(7,"Curarrehue","Curarrehue"), 
		  new Array(7,"Ercilla","Ercilla"), 
		  new Array(7,"Galvarino","Galvarino"), 
		  new Array(7,"Gorbea","Gorbea"), 
		  new Array(7,"Lautaro","Lautaro"), 
		  new Array(7,"Loncoche","Loncoche"),	  
		  new Array(7,"Lonquimay","Lonquimay"),
		  new Array(7,"Los Sauces","Los Sauces"), 
		  new Array(7,"Lumaco","Lumaco"), 
		  new Array(7,"Melipeuco","Melipeuco"), 
		  new Array(7,"Nueva Imperial","Nueva Imperial"), 
		  new Array(7,"Perquenco","Perquenco"), 
		  new Array(7,"Pitrufquen","Pitrufquen"),
		  new Array(7,"Pucon","Pucon"), 
		  new Array(7,"Puren","Puren"), 
		  new Array(7,"Renaico","Renaico"),	  
		  new Array(7,"Temuco","Temuco"),
		  new Array(7,"Teodoro Schmidt","Teodoro Schmidt"), 
		  new Array(7,"Traiguen","Traiguen"), 
		  new Array(7,"Victoria","Victoria"), 
		  new Array(7,"Villarrica","Villarrica"), 
		  
		  new Array(8,"Bucalemu","Bucalemu"),      //Libertador B. O'Higgins
		  new Array(8,"Chepica","Chepica"),
		  new Array(8,"Chimbarongo","Chimbarongo"),
		  new Array(8,"Codegua","Codegua"),
	      new Array(8,"Coinco","Coinco"),
	      new Array(8,"Coltauco","Coltauco"),
		  new Array(8,"Doñihue","Doñihue"),
		  new Array(8,"Graneros","Graneros"),
		  new Array(8,"La Estrella","La Estrella"),
		  new Array(8,"Las Cabras","Las Cabras"),
		  new Array(8,"Litueche","Litueche"),
		  new Array(8,"Lolol","Lolol"),
		  new Array(8,"Machali","Machali"),
		  new Array(8,"Malloa","Malloa"),
		  new Array(8,"Marchigue","Marchigue"),
		  new Array(8,"Nancagua","Nancagua"),
		  new Array(8,"Palmilla","Palmilla"),
		  new Array(8,"Paredones","Paredones"),
		  new Array(8,"Peumo","Peumo"),
		  new Array(8,"Pichidegua","Pichidegua"),
		  new Array(8,"Pichilemu","Pichilemu"),
		  new Array(8,"Placilla","Placilla"),
		  new Array(8,"Pumanque","Pumanque"),
		  new Array(8,"Quinta De Tilcoco","Quinta De Tilcoco"),
		  new Array(8,"Rancagua","Rancagua"),
		  new Array(8,"Rengo","Rengo"),
		  new Array(8,"Requinoa","Requinoa"),
		  new Array(8,"San Fernando","San Fernando"),
		  new Array(8,"San Francisco De Mostazal","San Francisco De Mostazal"),
		  new Array(8,"San Vicente","San Vicente"),
		  new Array(8,"Santa Amelia","Santa Amelia"),
		  new Array(8,"Santa Cruz","Santa Cruz"),
		  
		  new Array(9,"Ancud","Ancud"),      //Los Lagos
		  new Array(9,"Calbuco","Calbuco"),
		  new Array(9,"Castro","Castro"),
		  new Array(9,"Chaiten","Chaiten"),
		  new Array(9,"Chonchi","Chonchi"),
		  new Array(9,"Cochamo","Cochamo"),
		  new Array(9,"Curaco De Velez","Curaco De Velez"),
		  new Array(9,"Dolcahue","Dolcahue"),
		  new Array(9,"Fresia","Fresia"),
		  new Array(9,"Frutillar","Frutillar"),
		  new Array(9,"Futaleufu","Futaleufu"),
		  new Array(9,"Lago Ranco","Lago Ranco"),
		  new Array(9,"Llanquihue","Llanquihue"),
		  new Array(9,"Los Muermos","Los Muermos"),
		  new Array(9,"Maullin","Maullin"),
		  new Array(9,"Osorno","Osorno"),
		  new Array(9,"Palena","Palena"),
		  new Array(9,"Puerto Montt","Puerto Montt"),
		  new Array(9,"Puerto Octay","Puerto Octay"),
		  new Array(9,"Puerto Varas","Puerto Varas"),
		  new Array(9,"Puqueldon","Puqueldon"),
		  new Array(9,"Purranque","Purranque"),
		  new Array(9,"Queilen","Queilen"),
		  new Array(9,"Quellon","Quellon"),
		  new Array(9,"Quemchi","Quemchi"),
		  new Array(9,"Rio Negro","Rio Negro"),
		  new Array(9,"San Pablo","San Pablo"),
		  
		  new Array(10,"Corral","Corral"),      //Los Rios
		  new Array(10,"Futrono","Futrono"),
		  new Array(10,"La Union","La Union"),
		  new Array(10,"Lanco","Lanco"),
		  new Array(10,"Los Lagos","Los Lagos"),
		  new Array(10,"Mafil","Mafil"),
		  new Array(10,"Mariquina","Mariquina"),
		  new Array(10,"Paillaco","Paillaco"),
		  new Array(10,"Panguipulli","Panguipulli"),
		  new Array(10,"Rio Bueno","Rio Bueno"),
		  new Array(10,"Valdivia","Valdivia"),
		  
		  new Array(11,"Porvenir","Porvenir"),      //Magallanes
		  new Array(11,"Punta Arenas","Punta Arenas"),
		  new Array(11,"Torres Del Paine","Torres Del Paine"),
		  
		  new Array(12,"Cauquenes","Cauquenes"),      //Maule
		  new Array(12,"Chanco","Chanco"),
		  new Array(12,"Colbun","Colbun"),
		  new Array(12,"Constitucion","Constitucion"),
		  new Array(12,"Curepto","Curepto"),
		  new Array(12,"Curico","Curico"),
		  new Array(12,"Empedrado","Empedrado"),
		  new Array(12,"Hualañe","Hualañe"),
		  new Array(12,"Licanten","Licanten"),
	      new Array(12,"Linares","Linares"),
		  new Array(12,"Longavi","Longavi"),
		  new Array(12,"Maule","Maule"),
	      new Array(12,"Molina","Molina"),
		  new Array(12,"Parral","Parral"),
		  new Array(12,"Pelarco","Pelarco"),
	      new Array(12,"Pelluhue","Pelluhue"),
		  new Array(12,"Pencahue","Pencahue"),
		  new Array(12,"Rauco","Rauco"),
	      new Array(12,"Retiro","Retiro"),
		  new Array(12,"Romeral","Romeral"),
		  new Array(12,"Sagrada Familia","Sagrada Familia"),
		  new Array(12,"San Clemente","San Clemente"),
		  new Array(12,"San Javier","San Javier"),
		  new Array(12,"San Rafael","San Rafael"),
		  new Array(12,"Talca","Talca"),
		  new Array(12,"Teno","Teno"),
		  new Array(12,"Vichuquen","Vichuquen"),
		  new Array(12,"Villa Alegre","Villa Alegre"),
		  new Array(12,"Yerbas Buenas","Yerbas Buenas"),
		  
		  new Array(13,"Alhue","Alhue"),      //Region Metropolitana
		  new Array(13,"Buin","Buin"),
		  new Array(13,"Calera De Tango","Calera De Tango"),
		  new Array(13,"Cerrillos","Cerrillos"),
		  new Array(13,"Cerro Navia","Cerro Navia"),
		  new Array(13,"Colina","Colina"),
		  new Array(13,"Conchali","Conchali"),
		  new Array(13,"Curacavi","Curacavi"),
		  new Array(13,"El Bosque","El Bosque"),
		  new Array(13,"El Monte","El Monte"),
		  new Array(13,"Estacion Central","Estacion Central"),
		  new Array(13,"Huechuraba","Huechuraba"),
		  new Array(13,"Independencia","Independencia"),
		  new Array(13,"Isla De Maipo","Isla De Maipo"),
		  new Array(13,"La Cisterna","La Cisterna"),
		  new Array(13,"La Florida","La Florida"),
		  new Array(13,"La Granja","La Granja"),
		  new Array(13,"La Pintana","La Pintana"),
		  new Array(13,"La Reina","La Reina"),
		  new Array(13,"Lampa","Lampa"),
		  new Array(13,"Las Condes","Las Condes"),
		  new Array(13,"Lo Barnechea","Lo Barnechea"),
		  new Array(13,"Lo Espejo","Lo Espejo"),
		  new Array(13,"Lo Prado","Lo Prado"),
		  new Array(13,"Macul","Macul"),
		  new Array(13,"Maipu","Maipu"),
		  new Array(13,"Maria Pinto","Maria Pinto"),
		  new Array(13,"Melipilla","Melipilla"),
		  new Array(13,"Ñuñoa","Ñuñoa"),
		  new Array(13,"Padre Hurtado","Padre Hurtado"),
		  new Array(13,"Paine","Paine"),
		  new Array(13,"Pedro Aguirre Cerda","Pedro Aguirre Cerda"),
		  new Array(13,"Peñaflor","Peñaflor"),
		  new Array(13,"Peñalolen","Peñalolen"),
		  new Array(13,"Pirque","Pirque"),
		  new Array(13,"Providencia","Providencia"),
		  new Array(13,"Pudahuel","Pudahuel"),
		  new Array(13,"Puente Alto","Puente Alto"),
		  new Array(13,"Quilicura","Quilicura"),
		  new Array(13,"Quinta Normal","Quinta Normal"),
		  new Array(13,"Renca","Renca"),
		  new Array(13,"San Bernardo","San Bernardo"),
		  new Array(13,"San Joaquin","San Joaquin"),
		  new Array(13,"San Jose De Maipo","San Jose De Maipo"),
		  new Array(13,"San Jose De Melipilla","San Jose De Melipilla"),
		  new Array(13,"San Miguel","San Miguel"),
		  new Array(13,"San Pedro","San Pedro"),
		  new Array(13,"San Ramon","San Ramon"),
		  new Array(13,"Santiago","Santiago"),
		  new Array(13,"Talagante","Talagante"),
		  new Array(13,"Til Til","Til Til"),
		  new Array(13,"Vitacura","Vitacura"),
		  
		  new Array(14,"Alto Hospicio","Alto Hospicio"),      //Tarapaca
		  new Array(14,"Camiña","Camiña"),
		  new Array(14,"Colchane","Colchane"),
		  new Array(14,"Huara","Huara"),
		  new Array(14,"Iquique","Iquique"),
		  new Array(14,"Pica","Pica"),
		  new Array(14,"Pozo Almonte","Pozo Almonte"),
		  
		  new Array(15,"Algarrobo","Algarrobo"),       //Valparaiso
		  new Array(15,"Cabildo","Cabildo"),
		  new Array(15,"Casablanca","Casablanca"),
		  new Array(15,"Catemu","Catemu"),
		  new Array(15,"Con Con","Con Con"),
		  new Array(15,"El Tabo","El Tabo"),
		  new Array(15,"Hijuelas","Hijuelas"),
		  new Array(15,"Isla De Pascua","Isla De Pascua"),
		  new Array(15,"Isla Negra","Isla Negra"),
		  new Array(15,"La Ligua","La Ligua"),
		  new Array(15,"La Calera","La Calera"),
		  new Array(15,"La Cruz","La Cruz"),
		  new Array(15,"Limache","Limache"),
		  new Array(15,"Llay Llay","Llay Llay"),
		  new Array(15,"Los Andes","Los Andes"),
		  new Array(15,"Nogales","Nogales"),
		  new Array(15,"Olmue","Olmue"),
		  new Array(15,"Panquehue","Panquehue"),
		  new Array(15,"Papudo","Papudo"),
		  new Array(15,"Petorca","Petorca"),
		  new Array(15,"Puchuncavi","Puchuncavi"),
		  new Array(15,"Putaendo","Putaendo"),
		  new Array(15,"Quillota","Quillota"),
		  new Array(15,"Quilpue","Quilpue"),
		  new Array(15,"Quintero","Quintero"),
		  new Array(15,"San Antonio","San Antonio"),
		  new Array(15,"San Felipe","San Felipe"),
		  new Array(15,"Santa Maria","Santa Maria"),
		  new Array(15,"Valparaiso","Valparaiso"),
		  new Array(15,"Villa Alemana","Villa Alemana"),
		  new Array(15,"Viña Del Mar","Viña Del Mar"),
		  new Array(15,"Zapallar","Zapallar")
	  ); 
	  
	  if(valor==0)  {
		  document.getElementById("ciudad").disabled=true; 
	  }else{ 
		  document.getElementById("ciudad").options.length=0;
		  document.getElementById("ciudad").options[0]=new Option("Elige una Ciudad", "0"); 
		  for(i=0;i<arrayValores.length;i++) {
			  if(arrayValores[i][0]==valor) { 
				  document.getElementById("ciudad").options[document.getElementById("ciudad").options.length]=new Option(arrayValores[i][2], arrayValores[i][1]); 
			  } 
		  } 
		  document.getElementById("ciudad").disabled=false;  
	  } 
} 

function seleccinadoCiudad(value) { 
	var v1 = document.getElementById("comuna"); 
	var valor1 = v1.options[v1.selectedIndex].value; 
	var text1 = v1.options[v1.selectedIndex].text; 
	var v2 = document.getElementById("ciudad"); 
	var valor2 = v2.options[v2.selectedIndex].value; 
	var text2 = v2.options[v2.selectedIndex].text; 
} 