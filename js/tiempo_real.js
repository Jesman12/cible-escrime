/***Descripción general
*La función Score_TReel() es llamada en el archivo time.js linea 36
*La función llena un DIV con la lista de cibles disponibles en index.php linea 203
*El ciclo for crea una multiplexación de los cibles a visualizar (Actualmente solo se puede ver el score individual)
*ERRORES
	-Saturación del sistema y errores con los cibles
	-No hay tiempo real de TODOS los Scores a la vez	
*/
var rep = true; //Evita que se ejecute la operación constantemente
function Score_TReel(){
	var Cibles_Score = document.getElementsByClassName('SCORES');
	var C_Nom = document.getElementsByClassName('C_Nom');
	if(rep){
		for(var i = 0; i < C_Nom.length; i++){
				var linea = document.createElement('p');
				var contenido1 = document.createElement('a');
				var contenido2 = document.createElement('a');
				
				var C_SC_id = Cibles_Score[i].id;
				var obt_id = C_SC_id.substr(5);
				
				contenido1.className = "Nombre";
				contenido1.setAttribute("style", "font-weight:300; font-size:45px; font-weight:bold");
				contenido1.setAttribute("valor", i);
				contenido2.setAttribute("style", "font-weight:300; font-size:45px");
				
				linea.id = "p_CB"+obt_id;
				contenido1.id = "Nom"+obt_id;
				contenido2.id = "Puntaje"+obt_id;
				
				var Nom = C_Nom[i].innerHTML;
				var Nom_Score = Cibles_Score[i].innerHTML;
				
				var Nom_Cible = document.createTextNode(Nom + ' ');
				var Sc_Cible = document.createTextNode(Nom_Score);
				
				contenido1.appendChild(Nom_Cible);
				contenido2.appendChild(Sc_Cible);
				
				linea.appendChild(contenido1);
				linea.appendChild(contenido2);
				
				document.getElementById('T_reel').appendChild(linea); 
		}
		rep = false;
	}
	var elementosCibles = document.getElementsByClassName('Nombre');
	for(let i = 0; i < Cibles_Score.length; i++){
			(function(i){
				setTimeout(function(){
				var id_Nom = elementosCibles[i].id;
				var Nombre_id = id_Nom.substr(3);
				tipo = Nombre_id;
				//document.getElementById('Puntaje'+i).innerHTML = Cibles_Score[i].innerHTML;
				}, 500*i);
			})(i);
		}
}