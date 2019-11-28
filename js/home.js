var CIBLES_CONNECT = [];
var CIBLES_POUR_JOUER = [];
var jugadores = [];
var vinc;
var ip = "http://192.168.137.175/";
var inicial_tipo = 0;
var tipo = 0;
var FIN = false;
var seg = true;

var timestamp = null;
var puntos_ID1 = 0;
var nuevo = 0;
function cargar_push() 
{
			$.ajax({
			async:	true, 
			type: "POST",
			url: "mensajes.php",
			data: "",
			dataType:"html",
			success: function(data)
			{
				var encontrar = 'PUNTOS=';
				var ubicacion = data.indexOf(encontrar);
				var ubicacion2 = data.indexOf(encontrar + (ubicacion + 1));
				puntos = data.substr(data,ubicacion+7,2);
				
				var encontrar_ID = 'j';
				var ubicacion_ID = data.indexOf(encontrar_ID);
				if(inicial_tipo != tipo){
					//$('#div'+inicial_tipo).html("");
					inicial_tipo = tipo;
				}
					$('#div'+tipo).html(data);
					var n_jugador = 'puntos_ID' + tipo;
					if(!n_jugador){
						window[n_jugador] = 0;
						jugadores.push(n_jugador);	
					}
					var pts_jugador = jugadores.indexOf('puntos_ID'+tipo);
					var	jugador_activo = document.getElementsByClassName('j'+tipo);
						if(nuevo != jugador_activo.length){
							jugadores[pts_jugador] = 0;
							for(var p = 0; p < jugador_activo.length; p++){
								var pts = jugador_activo[p].getAttribute("class");
								var cible1_pts = pts.substr(3,1);
								if(cible1_pts == "3"){
									jugadores[pts_jugador] -= parseInt(cible1_pts);
									$('#ptsJ'+tipo).html("- "+cible1_pts);
								}else{
									jugadores[pts_jugador] += parseInt(cible1_pts);
									$('#ptsJ'+tipo).html("+ "+cible1_pts);
								}
								$('#SCORE'+tipo).html(jugadores[pts_jugador]);
								$('#Puntaje'+tipo).html(jugadores[pts_jugador]);
							}
							nuevo = jugador_activo.length;
						}
					
					$('#div'+tipo).children('.j'+tipo).css("display", "block");
			}
			});	
		setTimeout('cargar_push()',1000);
}

$(document).ready(function()
{
	cargar_push();
});