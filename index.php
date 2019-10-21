<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>CIBLE PANEL</title>
		<!--(ES-MX) INICIO META TAGS-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Panel de control de los CIBLES">
		<meta name="keywords" content="Escrime, Cibles">
		<meta name="author" content="Jesus Manuel CUERVO ITURBIDE">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--(ES-MX) FINAL META TAGS-->
		<!--(ES-MX) INICIO HOJAS DE ESTILOS -->
		<link rel="stylesheet" href="css/w3.css">
		<link rel="stylesheet" href="css/w3-theme-blue.css">
		<link rel="stylesheet" href="css/style.css?v2.0">
		<!--(ES-MX) FINAL HOJAS DE ESTILOS -->
		<!--(ES-MX) INICIO CÓDIGOS JAVASCRIPT-->
		<script language="javascript" src="js/jquery-3.4.1.min.js"></script>
		<script language="javascript" src="js/time.js?v0.1"></script>
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
	<header class="centrar-P w3-center w3-theme" style="height:200px">
		<a class="centrar-H" style="font-size:10vw;">PARAMETRES</a>
	</header>
	<div id="p1" class="w3-container w3-padding-16">
		<div class="w3-container">
			<span onclick="options('CIBLE')" class="centrar-P w3-button w3-block w3-left-align w3-border w3-green w3-hover-light-green w3-round-large" style="height:250px">
				<a class="centrar-H" style="font-size:7vw">SELECTIONNEZ LE CIBLE</a>
			</span>
			<!--(ES-MX) INICIO DIV DE BÚSQUEDA Y CONEXIÓN DE "CIBLES"-->
			<div id="CIBLE" class="w3-container w3-hide w3-center w3-pale-green w3-border w3-padding-32 w3-round-xlarge" style="width:100%">
				<input id="url_ip" class="w3-button w3-border w3-round-large w3-hover-white w3-center" placeholder="AJOUTER UN IP" type="text" style="width:100%; height:100px; font-size:30px" /><br>
				<button class="w3-button w3-khaki" style="width:100%; height:100px; font-size:20px" onclick="IP()">ENREGISTRER</button><hr>
				<button class="w3-button w3-khaki" style="width:90%; height:100px; font-size:20px" onclick="verificar()">SCAN</button>
				<div id="scan" style="display:none;">
					<!--(ES-MX) SE MUESTRA LA IP DEL USUARIO
						(ES-MX) SI SE CONECTA CON EL "CIBLE" SE MUESTRA LA IP DEL CIBLE CONECTADO-->
					<p>VOTRE ADRESSE IP EST: <a id="IP_Servidor"><?Php echo "$ip";?></a></p>
					<p style="display:none"><a id="IP_Base"><?Php echo "http://$addres";?></a></p>
					<p>IP: <b><a id="Dir_IP" class="w3-green"></a></b></p>
					<p style="display:none"><a id="error"></a></p>
					<div id="success">
						<!--(ES-MX) SE LISTAN TODOS LOS CIBLES DISPONIBLES EN LA RED-->
					</div>
				</div>
			</div>
			<!--(ES-MX) FINAL DIV DE BÚSQUEDA Y CONEXIÓN DE "CIBLES"-->
		</div>
		<!--(ES-MX) INICIO DIV DE CONFIGURACIÓN DE LOS JUEGOS-->
		<div class="w3-container w3-section">
			<span onclick="options('JEU')" class="centrar-P w3-button w3-block w3-left-align w3-border w3-red w3-hover-orange w3-round-large" style="height:250px">
				<a class="centrar-H" style="font-size:7vw">SELECTIONNEZ LE JEU</a>
			</span>

			<div id="JEU" class="w3-container w3-hide w3-center w3-pale-red w3-border w3-padding-32 w3-round-xlarge" style="width:100%">
				<div id="config" class="w3-container">
					<div id="cibles_connect" style="width:50%; height:100%; float:left;" class="w3-card-4">
						<header class="w3-center"><b>DISPONIBLE</b></header>
					</div>
					<div id="coordinacion" style="display:none; width:50%; height:100%; float:left;" class="w3-card-4">
						<header class="w3-center"><b>MODE</b></header>
						<!--(ES-MX) VINCULACIÓN DE LOS JUEGOS DE LOS "CIBLES"-->
						<input type="radio" name="tipo_enlaze" value="IDENTIQUE" onChange="javascript:vinc = 'IDENTIQUE';" checked />IDENTIQUE
						<input type="radio" name="tipo_enlaze" value="DIFFERENT" onChange="javascript:vinc = 'DIFFERENT';"/>DIFFÉRENT
					</div>
				</div>
				<hr>
				<div id="jeux" style="display:none;">
					<!--(ES-MX) OPCIONES DISPONIBLES DE JUEGOS-->
					<button class="w3-button w3-khaki" style="width:40%; height:100px" onclick="MARATHON();">MARATHON</button>
					<button class="w3-button w3-khaki" style="width:40%; height:100px" onclick="CONTRAT()">CONTRAT</button>
				</div>
			</div>
		</div>
		<!--(ES-MX) FINAL DIV DE CONFIGURACIÓN DE LOS JUEGOS-->
		
		<!--(ES-MX) INICIO DIV DE VISUALIZACIÓN DE RESULTADOS Y TIEMPO-->
		<div class="w3-container w3-section">
			<div id="status" class="w3-modal">
				<div class="w3-modal-content">
					<header class="w3-container w3-teal"> 
						<span onclick="document.getElementById('status').style.display='none'" class="w3-button w3-display-topright">&times;</span>
						<h2>JEU: <a id="jeu_select"><b>----</b></a></h2>
					</header>
					<div class="w3-container">
						<!--(ES-MX) INCIO DIV VINCULADO A "js/time.js"-->
						<div id="tiempo" class="w3-center" style="width:100%">
							<div class="chronometer">
								<!--(ES-MX) OBTENCIÓN DEL TIEMPO DE LA LIBRERÍA-->
								<div id="screen">00 : 00 : 00 : 00</div>
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
						<div class="w3-center">
							<p id="status_pts" style="font-weight:300; font-size:45px">SCORE: <a id="SCORE1">SCORE</a></p>
							<p id="status_cible" style="font-weight:300; font-size:45px"><a id="ptsJ1">PTS 1</a> pts</p>
							<hr>
							<button onclick="javascript:tipo='1';">VOIR 1</button>
							<button onclick="javascript:tipo='2';">VOIR 2</button>
							<p id="status_pts" style="font-weight:300; font-size:45px">SCORE: <a id="SCORE2">SCORE</a></p>
							<p id="status_cible" style="font-weight:300; font-size:45px"><a id="ptsJ2">PTS 1</a> pts</p>
						</div>
					</div>
					<footer class="w3-container w3-teal">
						<p>SEICOM <button class='w3-right w3-button' onclick='borrar();'>RESET</button></p>
					</footer>
				</div>
			</div>
		</div>
		<!--(ES-MX) FINAL DIV DE VISUALIZACIÓN DE RESULTADOS Y TIEMPO-->
	</div>
	<!--(ES-MX) INICIO OBTENCIÓN DE INFORMACIÓN DE LA BASE DE DATOS (PERMANECE OCULTA PARA EL USUARIO)-->
	<div id="p2" class="w3-container w3-padding-16" style="margin-bottom:30px; display:none">
		<div id="div1" style="width:50%; height:100%; float:left;">
			div 1
		</div>
		<div id="div2" style="width:50%; height:100%; float:left;">
			div 2
		</div>
	</div>
	<!--(ES-MX) FINAL OBTENCIÓN DE INFORMACIÓN DE LA BASE DE DATOS (PERMANECE OCULTA PARA EL USUARIO)-->
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
			var x = document.getElementById(id);
			if (x.className.indexOf("w3-show") == -1) {
				x.className += " w3-show";
			} else {
				x.className = x.className.replace(" w3-show", "");
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
									var A_Text = document.createTextNode("CIBLE " + ID_cible);
									var btn_Text = document.createTextNode('CONNECT');
									btn_conectar.appendChild(btn_Text);
									btn_conectar.className = "w3-button w3-teal";
									btn_conectar.setAttribute("onClick", "IP('"+ IP_cible +"')");
									btn_conectar.id = "Cible" + ID_cible;

									if (typeof(Storage) !== "undefined") {
									  // Store
									  sessionStorage.setItem(IP_cible, "CIBLE "+ID_cible);
									  // Retrieve
									} else {
									  alert("Sorry, your browser does not support Web Storage...");
									}

									A_IP.appendChild(A_Text);
									P_IP.appendChild(A_IP);
									P_IP.appendChild(btn_conectar);
									document.getElementById('success').appendChild(P_IP);
									document.getElementById('scan').style.display = 'block';
									alert("CIBLE TROUVÉ!");
								}
								
							}
						}
					});
			}
		}
		function borrar(){
			location.href = "limpiar.php";
		}
		function IP(CIBLE_IP){
			var ejecutar = true;
			for(var existe = 0; existe <= CIBLES_CONNECT.length; existe++){
				if(CIBLES_CONNECT[existe]){
					if(CIBLES_CONNECT[existe] == (CIBLE_IP || document.getElementById("url_ip").value)){
						CIBLES_CONNECT.splice(existe, 1);
						ejecutar = false;
						alert("DÉCONNECTÉ!");
					}
				}
			}
			if(ejecutar){
				if(!CIBLE_IP){
					ip = "http://" + document.getElementById("url_ip").value;
					CIBLES_CONNECT.push(document.getElementById("url_ip").value);
					alert("Connectecté à: " + ip);
				}else{
					ip = "http://" + CIBLE_IP;
					CIBLES_CONNECT.push(CIBLE_IP);
					alert("Connectecté à: " + ip);
				}
				document.getElementById("Dir_IP").innerHTML = ip;
			}
		}
	</script>
	<script language="javascript" src="js/jeu.js?v0.2"></script>
	<footer class="w3-container w3-bottom w3-theme w3-margin-top">
		<a>LP SEICOM - 2019</a>
		<button onclick="document.getElementById('status').style.display='block'" class="w3-right w3-button w3-black">STATUS</button>
		<button onclick="document.getElementById('p2').style.display='block'" class="w3-right w3-button w3-black">PTS</button>
	</footer>
	</body>
</html>