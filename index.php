<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>CIBLE PANEL</title>
		<link rel="shortcut icon" href="img/FFE.png">
		<!--(ES-MX) INICIO META TAGS-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Panel de control de los CIBLES">
		<meta name="keywords" content="Escrime, Cibles">
		<meta name="author" content="Jesus Manuel CUERVO ITURBIDE">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="manifest" href="manifest.json">
		<!--(ES-MX) FINAL META TAGS-->
		<!--(ES-MX) INICIO HOJAS DE ESTILOS -->
		<link rel="stylesheet" href="css/w3.css">
		<link rel="stylesheet" href="css/w3-theme-blue.css">
		<link rel="stylesheet" href="css/style.css?v1.0">
		<!--(ES-MX) FINAL HOJAS DE ESTILOS -->
		<!--(ES-MX) INICIO CÓDIGOS JAVASCRIPT-->
		<script language="javascript" src="js/jquery-3.4.1.min.js"></script>
		<script language="javascript" src="js/time.js?v1.6"></script>
		<script language="javascript" src="js/home.js"></script>
		<!--(ES-MX) FINAL CÓDIGOS JAVASCRIPT-->
	</head>

	<body>
	<!--(ES-MX) OBTENCIÓN DE IP LOCAL POR PHP
		(ES-MX) FILTRACIÓN PARA LA OBTENCIÓN DE LA IP
		(ES-MX) NUEVA CADENA CON LA IP DEL DISPOSITIVO-->
	<?Php
		$ip = $_SERVER['REMOTE_ADDR'];
		$search = substr($ip,12);
		$addres = substr($ip,0,12);
	?>
	
	<!--INICIO UI-->
	<div class="bgimg w3-display-container w3-animate-opacity w3-text-white" style="padding-top:10px">
		<div class="w3-display-topleft w3-padding-large w3-xlarge">
			<img src="img/FFE.png" style="width:30%; height:40%;"/>
		</div>
		<div class="w3-display-topright w3-padding-large w3-xlarge">
			<button onclick="options('SCAN')" class="w3-button w3-round-large w3-black">CONFIG.</button>
		</div>
		<div id="id01" class="w3-modal" style="color:black;">
			<div class="w3-modal-content w3-card-4 w3-animate-zoom">
				<header class="w3-container w3-black"> 
					<span onclick="document.getElementById('id01').style.display='none'" 
					class="w3-button w3-black w3-xlarge w3-display-topright">&times;</span>
					<h2>PARAMÈTRES</h2>
				</header>

				<div class="w3-bar w3-border-bottom">
					<button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Trouve')">TROUVÉ</button>
					<button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Avances')">AVANCÉS</button>
					<button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Information')">INFORMATION</button>
				</div>

				<div id="Trouve" class="w3-container city">
					<h1>TROUVÉ</h1>
					<div id="SEARCH" class="w3-center" style="display:block;">
					<!--(ES-MX) INICIO DIV DE BÚSQUEDA Y CONEXIÓN DE "CIBLES"-->			
						<button id="verificar" class="w3-button w3-round-large w3-khaki" style="width:90%; height:100px; font-size:20px" onclick="verificar()">SCAN</button>
						<div id="scan" style="display:none;">
							<p style="display:none"><a id="IP_Base"><?Php echo "http://$addres";?></a></p>
							<p style="display:none"><a id="error"></a></p>
							<div id="success">
							<!--(ES-MX) SE LISTAN TODOS LOS CIBLES DISPONIBLES EN LA RED-->
							</div>
						</div>
					<!--(ES-MX) FINAL DIV DE BÚSQUEDA Y CONEXIÓN DE "CIBLES"-->
					</div>
				</div>

				<div id="Information" class="w3-container city">
					<h1>INFORMATION</h1>
					<p class="CIBLES"><b>VERSION:</b> 2.1</p>
					<p class="CIBLES"><b>REVIEW:</b> 22/11/2019</p>
					<p class="CIBLES"><b>DÉVELOPPEUR:</b> Jesus Manuel Cuervo Iturbide</p>
					<p class="CIBLES"><b>CONTACT:</b>jesman-dev@outlook.com</p>
				</div>

				<div id="Avances" class="w3-container city">
					<h1>PARAMÈTRES AVANCÉS</h1>
					<input id="url_ip" class="w3-button w3-border w3-round-large w3-hover-white w3-center" placeholder="AJOUTER UN IP" type="text" style="width:100%; height:100px; font-size:30px" /><br>
					<button class="w3-button w3-khaki" style="width:100%; height:100px; font-size:20px" onclick="IP()">ENREGISTRER</button><hr>
				</div>

				<div class="w3-container w3-light-grey w3-padding">
					<button class="w3-button w3-right w3-white w3-border" onclick="document.getElementById('id01').style.display='none'">Fermer</button>
				</div>
			</div>
		</div>
		<div id="JOUER" class="w3-display-middle w3-center">
			<button class="w3-jumbo w3-animate-top w3-btn w3-round-xlarge w3-yellow" onclick="options('JEU')">JOUER</button>
			<br>
			<br>
			<hr class="w3-border-grey" style="margin:auto;width:40%">
			<p class="w3-large w3-center">Fédération Française d'Escrime</p>
		</div>
		<!--(ES-MX) INICIO PARÁMETROS DE JUEGOS-->
		<div id="JEU" class="w3-display-middle w3-center" style="display:none; width:100%">
			<div id="config" class="w3-container">
				<button onclick="options('JEU')" class="w3-button w3-black">RELOAD</button>
				<div id="cibles_connect" style="width:100%; height:100%; float:left;" class="w3-card-4">
					<header class="w3-center"><b>DISPONIBLE</b></header>
				</div>
				<div id="coordinacion" style="display:none; width:100%; height:100%; float:left;" class="w3-card-4">
					<header class="w3-center"><b>MODE</b></header>
					<!--(ES-MX) VINCULACIÓN DE LOS JUEGOS DE LOS "CIBLES"-->
					<input type="radio" name="tipo_enlaze" value="IDENTIQUE" onChange="javascript:vinc = 'IDENTIQUE';" checked />IDENTIQUE
					<input type="radio" name="tipo_enlaze" value="DIFFERENT" onChange="javascript:vinc = 'DIFFERENT';"/>DIFFÉRENT
				</div>
			</div>
			<hr>
			<div id="jeux" class="w3-row-padding" style="display:none; width:100%">
				<!--(ES-MX) OPCIONES DISPONIBLES DE JUEGOS-->
				<div class="w3-container s6 w3-center w3-padding">
					<h1>SET TIME</h1>
					<center>
					<table class="w3-center">
						<tr>
							<td>
								<button class="w3-button w3-black w3-round-large" onclick="tiempo('plus','M','1')" style="width:100%">+</button>
							</td>
							<td>
								
							</td>
							<td>
								<button class="w3-button w3-black w3-round-large" onclick="tiempo('plus','S','15')" style="width:100%">+</button>
							</td>
							<td>
								
							</td>
						</tr>
						
						<tr>
							<td>
								<input id="t_M" class="w3-center" type="number" min="0" max="59" value="01" disabled onChange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"/>
							</td>
							<td>
								<label>min</label>
							</td>
							<td>
								<input id="t_S" class="w3-center" type="number" min="0" max="59" value="00" disabled onChange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"/>
							</td>
							<td>
								<label>s</label>
							</td>
						</tr>
						
						<tr>
							<td>
								<button class="w3-button w3-black w3-round-large" onclick="tiempo('moins','M','1')" style="width:100%">-</button>
							</td>
							<td>
								
							</td>
							<td>
								<button class="w3-button w3-black w3-round-large" onclick="tiempo('moins','S','15')" style="width:100%">-</button>
							</td>
							<td>
								
							</td>
						</tr>
					</table>
					<center>
				</div><br>
				<div class="w3-col s6 w3-center">
					<button id="J_Marathon" class="w3-button w3-khaki" style="width:100%; height:100px" onclick="MARATHON();">MARATHON</button>
				</div>
				<div class="w3-col s6 w3-center">
					<button id="J_Contrat" class="w3-button w3-khaki" style="width:100%; height:100px" onclick="CONTRAT()">CONTRAT</button>
				</div>
			</div>
		</div>
		<!--(ES-MX) FIN PARÁMETROS DE JUEGOS-->
		<!--(ES-MX) INICIO DIV DE VISUALIZACIÓN DE RESULTADOS Y TIEMPO-->
		<div class="w3-container w3-section">
			<div id="status" class="w3-modal">
				<div class="w3-modal-content w3-border w3-round-large w3-border-black">
					<header class="w3-container w3-indigo w3-border w3-round-large"> 
						<span onclick="document.getElementById('status').style.display='none'" class="w3-button w3-display-topright">&times;</span>
						<h2>JEU: <a id="jeu_select"><b>----</b></a></h2>
					</header>
					<div class="w3-container w3-light-grey">
						<!--(ES-MX) INCIO DIV VINCULADO A "js/time.js"-->
						<div id="tiempo" class="w3-center" style="width:100%">
							<div class="chronometer">
								<!--(ES-MX) OBTENCIÓN DEL TIEMPO DE LA LIBRERÍA-->
								<div id="screen">00 : 00 : 00</div>
								<!--(ES-MX) BOTONES NO DISPONIBLES PARA EL USUARIO-->
								<div class="buttons" style="display:none;">
									<button class="emerald" onclick="start()">START &#9658;</button>
									<button class="emerald" onclick="stop()">STOP &#8718;</button>
									<button class="emerald" onclick="resume()" >RESUME &#8634;</button>
									<button class="emerald" onclick="reset()">RESET &#8635;</button>
								</div>
							</div>
						</div>
						<!--(ES-MX) FINAL VINCULADO A "js/time.js"-->
						
						<div class="w3-center w3-content w3-display-container" id="points" style="color:black; padding-top:20px">
						<div id="T_reel" class="MyScore"></div>
						<!--(ES-MX) CREACION DE SCORES DINÁMICOS-->
							<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
							<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
						</div>
						
					</div>
					<footer class="w3-container w3-indigo w3-border w3-round-large">
						<button class='w3-right w3-button' onclick='borrar();'>RESET</button>
					</footer>
				</div>
			</div>
		</div>
		<!--(ES-MX) FINAL DIV DE VISUALIZACIÓN DE RESULTADOS Y TIEMPO-->
			
		<!--(ES-MX) INICIO OBTENCIÓN DE INFORMACIÓN DE LA BASE DE DATOS (PERMANECE OCULTA PARA EL USUARIO)-->
		<div id="p2" class="w3-container w3-padding-16" style="margin-bottom:30px; display:none"></div>
		<!--(ES-MX) FINAL OBTENCIÓN DE INFORMACIÓN DE LA BASE DE DATOS (PERMANECE OCULTA PARA EL USUARIO)-->
		
		<div class="w3-display-bottomleft w3-padding-large">
			<a><b>LP SEICOM - 2019</b></a><a class="w3-center"></a>
		</div>
		<div class="w3-display-bottomright w3-padding-large">
			<button onclick="document.getElementById('status').style.display='block'" class="w3-button w3-black w3-round-large">STATUS</button>
			<button style="display:none;" onclick="document.getElementById('p2').style.display='block'" class="w3-button w3-black">PTS</button>
		</div>
	</div>
	</div>
	</div>
	<!--FIN UI-->
	
	<script>
		//(ES-MX) FUNCIÓN LLAMADA POR LOS SPAN "SELECTIONNEZ..."
		function options(id) {
			//(ES-MX) ANTES DE MOSTRAR LOS "CIBLES" DISPONIBLES, SE ELIMINA TODA LA INFORMACIÓN PREVIA
			var vaciar = document.getElementById("cibles_connect");
				while(vaciar.firstChild){
					vaciar.removeChild(vaciar.firstChild);
				}
			var elementos = 0;
			//(ES-MX) SUB-FUNCIÓN DE LISTAR CADA "CIBLES"
				// (ES-MX) POR CADA "CIBLE" ENCONTRADO EN EL ARRAY
				// (ES-MX) SE CREA UN CHECKBOX CON LA FUNCIÓN "incluir(this)"
				// (ES-MX) SE CREA UN LABEL CON LA IP DEL "CIBLE"
			CIBLES_CONNECT.forEach(opt);
			function opt(elemento){
					var input_checkbox = document.createElement('input');
					var label_checkbox = document.createElement('label');
					var p = document.createElement('p');
					var nom_txt = sessionStorage.getItem(elemento);
					var txt_checkbox = document.createTextNode(nom_txt);
					input_checkbox.id = "CIBLE3";
					input_checkbox.value = elemento;
					input_checkbox.setAttribute("type","checkbox");
					input_checkbox.setAttribute("onChange","incluir(this)");
					label_checkbox.setAttribute("for","CIBLE3");
					label_checkbox.appendChild(txt_checkbox);
					p.setAttribute("style","font-size:20px");
					p.appendChild(input_checkbox);
					p.appendChild(label_checkbox);
					elementos++;
					document.getElementById("cibles_connect").appendChild(p);
			}
			// (ES-MX) SI HAY MÁS DE 1 "CIBLE" CONECTADO
			// (ES-MX) MUESTRA LA CONFIGURACIÓN DE COORDINACIÓN ENTRE ELLOS
			if(elementos > 1){
				document.getElementById('coordinacion').style.display = 'block';
			}else{
				document.getElementById('coordinacion').style.display = 'none';
			}
			// (ES-MX) MUESTRA LOS DIV CUANDO SE LES DA CLICK POR PRIMERA VEZ
			// (ES-MX) OCULTA LOS DIV CUANDO SE LES DA CLICK POR SEGUNDA VEZ
			if(id == "SCAN"){
				document.getElementById('id01').style.display='block';
				openCity(event, 'Trouve');
			}
			if(id == "JEU"){
				CIBLES_POUR_JOUER.forEach(function(){CIBLES_POUR_JOUER.shift();});
				document.getElementById('jeux').style.display = 'none';
				document.getElementById('JOUER').style.display = 'none';
				document.getElementById('JEU').style.display = 'block';
			}
		}
		function incluir(ip){
			var borrar = false;
			for(var existe = 0; existe <= CIBLES_POUR_JOUER.length; existe++){
				if(CIBLES_POUR_JOUER[existe] == ip.value){
					CIBLES_POUR_JOUER.splice(existe, 1);
					borrar = true;
					alert("DÉCONNECTÉ!");
				}
			}
			if(!borrar){
				CIBLES_POUR_JOUER.push(ip.value);
			}
			if(CIBLES_POUR_JOUER.length > 0){
				document.getElementById('jeux').style.display = 'block';
			}else {
				document.getElementById('jeux').style.display = 'none';
			}
		}
	</script>
	<script>
		function verificar(){
			CIBLES_CONNECT.forEach(function(){CIBLES_CONNECT.shift();});
			var vaciar = document.getElementById("success");
				while(vaciar.firstChild){
					vaciar.removeChild(vaciar.firstChild);
				}
			var busqueda = document.getElementById('IP_Base').innerHTML;
			for(var s = 0; s <= 254; s++){
				$.ajax({
						async:	true, 
						type: "GET",
						url: busqueda+s,
						data: "Start",
						dataType:"html",
						success: function(data, textStatus, jqXHR){
							if(textStatus == "success"){
								var buscar_IP_cible = "IP:";
								var buscar_ID_cible = "id:";
								var buscar_IP_FIN = "</html>";
								var pos_IP_cible = data.indexOf(buscar_IP_cible);
								var pos_ID_cible = data.indexOf(buscar_ID_cible);
								var IP_cible = data.substr(pos_IP_cible+4);
								var ID_cible = data.substr(pos_ID_cible+4);
							if (IP_cible.length <= 30) {
									var pos_IP_FIN = IP_cible.indexOf(buscar_IP_FIN);
									var pos_ID_FIN = ID_cible.indexOf("IP:");
									IP_cible = IP_cible.substr(0,pos_IP_FIN-2);
									ID_cible = ID_cible.substr(0,pos_ID_FIN-2);
									var btn_conectar = document.createElement("button");
									var P_IP = document.createElement("p");
									var A_IP = document.createElement("a");
									var A_Text = document.createTextNode("CIBLE " + ID_cible + " ");
									var btn_Text = document.createTextNode('CONNECTER');
									btn_conectar.appendChild(btn_Text);
									btn_conectar.className = "w3-button w3-green";
									btn_conectar.setAttribute("onClick", "IP('"+ IP_cible +"','"+ ID_cible +"')");
									btn_conectar.setAttribute("style", "font-size:30px");
									A_IP.setAttribute("style", "font-size:30px");
									btn_conectar.id = "Cible" + ID_cible;

									if (typeof(Storage) !== "undefined") {
										sessionStorage.setItem(IP_cible, "CIBLE "+ID_cible);
									} else {
									  alert("Sorry, your browser does not support Web Storage...");
									}
									P_IP.className = "CIBLES w3-border w3-border-grey w3-round-xlarge";
									A_IP.appendChild(A_Text);
									P_IP.appendChild(A_IP);
									P_IP.appendChild(btn_conectar);
									document.getElementById('success').appendChild(P_IP);
									document.getElementById('scan').style.display = 'block';
									
									var div_points = document.getElementById("points");
									var div_status_cible = document.createElement("div");
									var p_status_cible_joueur = document.createElement("p");
									var p_status_cible = document.createElement("p");
									var p_status_cible_pts = document.createElement("p");
									var txt_p_SC_joueur = document.createTextNode("CIBLE "+ID_cible);
									var txt_p_SC = document.createTextNode("SCORE: ");
									var txt_p_SC_pts = document.createTextNode("PTS ");
									
									var a_status_cible = document.createElement("a");
									var a_status_cible_pts = document.createElement("a");
									
									a_status_cible.id = "SCORE" + ID_cible;
									a_status_cible.className = "SCORES";
									a_status_cible_pts.id = "ptsJ" + ID_cible;
									p_status_cible_joueur.className = 'C_Nom';
									
									p_status_cible_joueur.setAttribute("style", "font-weight:300; font-size:45px; font-weight:bold");
									p_status_cible.setAttribute("style", "font-weight:300; font-size:45px");
									p_status_cible_pts.setAttribute("style", "font-weight:300; font-size:45px");
									
									p_status_cible_joueur.appendChild(txt_p_SC_joueur);
									p_status_cible.appendChild(txt_p_SC);
									p_status_cible_pts.appendChild(txt_p_SC_pts);
									
									p_status_cible.appendChild(a_status_cible);
									p_status_cible_pts.appendChild(a_status_cible_pts);
									
									div_status_cible.id = "SC"+ID_cible;
									div_status_cible.className = "MyScore";
									div_status_cible.setAttribute("style","display:none");
									div_status_cible.appendChild(p_status_cible_joueur);
									div_status_cible.appendChild(p_status_cible);
									div_status_cible.appendChild(p_status_cible_pts);
									
									div_points.appendChild(div_status_cible);
									
									var div_SC = document.createElement("div");
									var txt_div_SC = document.createTextNode("div" + ID_cible);
									div_SC.id = "div" + ID_cible;
									div_SC.appendChild(txt_div_SC);
									div_SC.setAttribute("style","height:100%; float:left");
									document.getElementById("p2").appendChild(div_SC);
									//alert("CIBLE TROUVÉ!");
								}
								
							}
						}
					});
			}
		}
		function borrar(){
			location.href = "limpiar.php";
		}
		function IP(CIBLE_IP,ID){
			var ejecutar = true;
			var SC = sessionStorage.getItem(CIBLE_IP);
				SC = SC.substr(6,1);
			for(var existe = 0; existe <= CIBLES_CONNECT.length; existe++){
				if(CIBLES_CONNECT[existe]){
					if(CIBLES_CONNECT[existe] == (CIBLE_IP || document.getElementById("url_ip").value)){
						CIBLES_CONNECT.splice(existe, 1);
						ejecutar = false;
						document.getElementById("SC"+SC).style.display = 'none';
						document.getElementById("div"+SC).style.display = 'none';
						document.getElementById("Cible"+ID).innerHTML = "CONNECTER";
						document.getElementById("Cible"+ID).className = "w3-button w3-green";
						alert("DÉCONNECTÉ!");
					}
				}
			}
			if(ejecutar){
				if(!CIBLE_IP){
					ip = "http://" + document.getElementById("url_ip").value;
					CIBLES_CONNECT.push(document.getElementById("url_ip").value);
					document.getElementById("Cible"+ID).innerHTML = "DÉCONNECTER";
					document.getElementById("Cible"+ID).className = "w3-button w3-red";
					//alert("CONNECTÉ!");
				}else{
					ip = "http://" + CIBLE_IP;
					CIBLES_CONNECT.push(CIBLE_IP);
					document.getElementById("Cible"+ID).innerHTML = "DÉCONNECTER";
					document.getElementById("Cible"+ID).className = "w3-button w3-red";
					//alert("CONNECTÉ!");
				}
				document.getElementById("SC"+SC).style.display = 'none';
				document.getElementById("div"+SC).style.display = 'block';
			}
		}
	</script>
	<script>
		var slideIndex = 1;
		showDivs(slideIndex);

		function plusDivs(n) {
		  showDivs(slideIndex += n);
		}

		function showDivs(n) {
			var i;
			var x = document.getElementsByClassName("MyScore");
			if(x[0]){
				if (n > x.length) {slideIndex = 1}
				if (n < 1) {slideIndex = x.length}
				for (i = 0; i < x.length; i++) {
					x[i].style.display = "none";  
				}
				x[slideIndex-1].style.display = "block";
				var MyScore_ID = x[slideIndex-1].id;
				if(MyScore_ID != "T_reel"){
					var SC_id = MyScore_ID.substr(2);
					tipo = SC_id; 
				}else{
					Score_TReel();
				}
			}
		}
		function tiempo(PouM,C,T){
			if(PouM == "plus"){
				if(document.getElementById('t_'+C+'').value < 59){
					document.getElementById('t_'+C+'').value = parseInt(document.getElementById('t_'+C+'').value) + parseInt(T);
					if(document.getElementById('t_'+C+'').value < 10){
						document.getElementById('t_'+C+'').value = "0" + document.getElementById('t_'+C+'').value;
					}if(document.getElementById('t_'+C+'').value == 60){
						document.getElementById('t_'+C+'').value = "59";
					}
				}
			}
			if(PouM == "moins"){
				if(document.getElementById('t_'+C+'').value > 0){
					if(document.getElementById('t_'+C+'').value == 59){
						document.getElementById('t_'+C+'').value = "60";
					}
					document.getElementById('t_'+C+'').value = parseInt(document.getElementById('t_'+C+'').value) - parseInt(T);
					if(document.getElementById('t_'+C+'').value < 10){
						document.getElementById('t_'+C+'').value = "0" + document.getElementById('t_'+C+'').value;
					}
				}
			}
		}
		var rep = true;
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
						
						contenido1.id = "Nom"+obt_id;
						contenido2.id = "Puntaje"+i;
						
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
			for(var i = 0; i < Cibles_Score.length; i++){
					var id_Nom = document.getElementsByClassName('Nombre')[i].id;
					var Nombre_id = id_Nom.substr(3);
					tipo = Nombre_id;
					document.getElementById('Puntaje'+i).innerHTML = Cibles_Score[i].innerHTML;
			}
		}
	</script>
	<script language="javascript" src="js/jeu.js?v1.8"></script>
	<script language="javascript" src="js/UI.js"></script>
	</body>
</html>