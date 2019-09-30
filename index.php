<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<title>CIBLE PANEL</title>
<style>
	.centrar-P {
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.centrar-H {
		line-height: 200px;
	}
	#screen {
		font-family: Calibri,Arial;
		font-weight: 300;
		font-size: 60px;
		width: 100%;
		height: 50px;
		color: gray;
		letter-spacing: 3px;
	}
	p {
		font-family: Calibri,Arial;
		font-weight: 400;
		font-size: 60px;
	}
</style>
<script language="javascript" src="js/jquery-3.4.1.min.js"></script>
<script>
var ip = "http://192.168.137.175/";
var FIN = false;
var seg = true;
window.onload = function() {
   pantalla = document.getElementById("screen");
}
var isMarch = false; 
var acumularTime = 0; 
function start () {
         if (isMarch == false) { 
            timeInicial = new Date();
            control = setInterval(cronometro,10);
            isMarch = true;
            }
         }
function cronometro () { 
         timeActual = new Date();
         acumularTime = timeActual - timeInicial;
         acumularTime2 = new Date();
         acumularTime2.setTime(acumularTime); 
         cc = Math.round(acumularTime2.getMilliseconds()/10);
         ss = acumularTime2.getSeconds();
         mm = acumularTime2.getMinutes();
         hh = acumularTime2.getHours()-1;
         if (cc < 10) {cc = "0"+cc;}
         if (ss < 10) {ss = "0"+ss;} 
         if (mm < 10) {mm = "0"+mm;}
         if (hh < 10) {hh = "0"+hh;}
         pantalla.innerHTML = hh+" : "+mm+" : "+ss+" : "+cc;
		 if(mm == 1){
			stop();
			document.getElementById('status_cible').style.display = "none";
			document.getElementById('status_pts').style.color = "green";
			document.getElementById('screen').style.color = "red";
			FIN = true;
		}
         }

function stop () { 
         if (isMarch == true) {
            clearInterval(control);
            isMarch = false;
            }     
         }      

function resume () {
         if (isMarch == false) {
            timeActu2 = new Date();
            timeActu2 = timeActu2.getTime();
            acumularResume = timeActu2-acumularTime;
            
            timeInicial.setTime(acumularResume);
            control = setInterval(cronometro,10);
            isMarch = true;
            }     
         }
function reset () {
         if (isMarch == true) {
            clearInterval(control);
            isMarch = false;
            }
         acumularTime = 0;
         pantalla.innerHTML = "00 : 00 : 00 : 00";
         }
</script>
<script language="javascript">
var timestamp = null;
var puntos_ID1 = 0;
var nuevo = 0;
function cargar_push() 
{ 
	$.ajax({
	async:	true, 
    type: "POST",
    url: "httpush.php",
    data: "&timestamp="+timestamp,
	dataType:"html",
    success: function(data)
	{	
		var json    	   = eval("(" + data + ")");
		timestamp 		   = json.timestamp;
		mensaje     	   = json.mensaje;
		id        		   = json.id;
		status      	   = json.status;
		tipo      	   	   = json.tipo;
		
		if(timestamp == null)
		{
		
		}
		else
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
				puntos = data.substr(ubicacion+7,2);
				$('#div'+tipo).html(data); 
				var JEU1 = document.getElementsByClassName('j1');
				if(nuevo != JEU1.length){
					puntos_ID1 = 0;
					for(var p = 0; p < JEU1.length; p++){
						var pts = JEU1[p].getAttribute("class");
						var cible1_pts = pts.substr(3,1);
						if(cible1_pts == "3"){
							puntos_ID1 -= parseInt(cible1_pts);
							$('#ptsJ1').html("- "+cible1_pts);
						}else{
							puntos_ID1 += parseInt(cible1_pts);
							$('#ptsJ1').html("+ "+cible1_pts);
						}
						$('#SCORE').html(puntos_ID1);
					}
					nuevo = JEU1.length;
				}
				$('#div'+tipo).children('.j'+tipo).css("display", "block");
			}
			});	
		}
		setTimeout('cargar_push()',1000);
		    	
    }
	});		
}

$(document).ready(function()
{
	cargar_push();
});	 
</script>
</head>

<body>
<?Php
	$ip = $_SERVER['REMOTE_ADDR'];
	$search = substr($ip,12);
	$addres = substr($ip,0,12);
?>
<header class="centrar-P w3-center w3-theme" style="height:250px">
<a class="centrar-H" style="font-size:100px;">PARAMETRES</a>
</header>
<div id="p1" class="w3-container w3-padding-16">
	<div class="w3-container">
		<span onclick="options('CIBLE')" class="centrar-P w3-button w3-block w3-left-align w3-border w3-green w3-hover-light-green w3-round-large" style="height:250px">
			<a class="centrar-H" style="font-size:50px">SELECTIONNEZ LE CIBLE</a>
		</span>

		<div id="CIBLE" class="w3-container w3-hide w3-center w3-pale-green w3-border w3-padding-32 w3-round-xlarge" style="width:100%">
		  <input id="url_ip" class="w3-button w3-border w3-round-large w3-hover-white w3-center" placeholder="AJOUTER UN IP" type="text" style="width:45%; height:100px; font-size:30px" />
		  <button class="w3-button w3-khaki" style="width:45%; height:100px; font-size:20px" onclick="IP()">ENREGISTRER</button><hr>
		  <button class="w3-button w3-khaki" style="width:90%; height:100px; font-size:20px" onclick="verificar()">SCAN</button>
		  <div id="scan" style="display:none;">
			  <p>VOTRE ADRESSE IP EST: <a id="IP_Servidor"><?Php echo "$ip";?></a></p>
			  <p style="display:none"><a id="IP_Base"><?Php echo "http://$addres";?></a></p>
			  <p>IP: <b><a id="Dir_IP" class="w3-green"></a></b></p>
			  <p style="display:none"><a id="error"></a></p>
			  <p>CIBLE IP: <a id="success">----</a><button id="success_IP" class="w3-button w3-teal" style="visibility:hidden" onclick="IP('success')">CONNECT</button></p>
		  </div>
		</div>
	</div>
	<div class="w3-container w3-section">
		<span onclick="options('JEU')" class="centrar-P w3-button w3-block w3-left-align w3-border w3-red w3-hover-orange w3-round-large" style="height:250px">
			<a class="centrar-H" style="font-size:50px">SELECTIONNEZ LE JEU</a>
		</span>

		<div id="JEU" class="w3-container w3-hide w3-center w3-pale-red w3-border w3-padding-32 w3-round-xlarge" style="width:100%">
		  <button class="w3-button w3-khaki" style="width:30%; height:100px" onclick="MARATHON();">MARATHON</button>
		  <button class="w3-button w3-khaki" style="width:30%; height:100px" onclick="CONTRAT()">CONTRAT</button>
		  <button class="w3-button w3-khaki" style="width:30%; height:100px" onclick="MULTIPLE()">MULTIPLE CIBLES</button>
		</div>
	</div>
	<div class="w3-container w3-section">
	  <div id="status" class="w3-modal">
		<div class="w3-modal-content">
		  <header class="w3-container w3-teal"> 
			<span onclick="document.getElementById('status').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<h2>JEU: <a id="jeu_select"><b>----</b></a></h2>
		  </header>
		  <div class="w3-container">
			<div id="tiempo" class="w3-center" style="width:100%">
				<div class="chronometer">
					<div id="screen">00 : 00 : 00 : 00</div>
					<div class="buttons" style="display:none;">
						<button class="emerald" onclick="start()">START &#9658;</button>
						<button class="emerald" onclick="stop()">STOP &#8718;</button>
						<button class="emerald" onclick="resume()" >RESUME &#8634;</button>
						<button class="emerald" onclick="reset()">RESET &#8635;</button>
					</div>
				</div>
			</div>
			<div class="w3-center">
				<p id="status_pts" style="font-weight:300; font-size:45px">SCORE: <a id="SCORE">SCORE</a></p>
				<p id="status_cible" style="font-weight:300; font-size:45px"><a id="ptsJ1">PTS 1</a> pts</p>
			</div>
		  </div>
		  <footer class="w3-container w3-teal">
			<p>SEICOM <button class='w3-right w3-button' onclick='borrar();'>RESET</button></p>
		  </footer>
		</div>
	  </div>
	</div>
</div>
<div id="p2" class="w3-container w3-padding-16" style="margin-bottom:30px; display:none">
	<div id="div1" style="width:200px; height:100%; float:left;">
	div 1
	</div>
	<div id="div2" style="width:200px; height:100%; float:left;">
	div 2
	</div>
</div>
<script type="text/javascript">
var x = document.getElementsByClassName('j1');
for(var i = 0; i <= x.length; i++){
	x[0].getAttribute("class");
	document.getElementById("ptsJ1").innerHTML = x[i];
}	
</script>
<script>
function options(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
<script>
	function verificar(){
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
							alert("CIBLE TROUVÉ!");
							var buscar_IP_cible = "IP:";
							var pos_IP_cible = data.indexOf(buscar_IP_cible);
							var IP_cible = data.substr(pos_IP_cible+4);
							$('#success').html(IP_cible);
							document.getElementById('success_IP').style.visibility = 'visible';
							document.getElementById('scan').style.display = 'block';
						}
					}
				});
		}
	}
</script>
<script>
	var a = 0;
	var b = 0;
	var c = 0;
	FIN = false;
function getRandomInt(max){
		return Math.floor(Math.random() * Math.floor(max));
	}
function MARATHON() 
{
	document.getElementById('jeu_select').innerHTML = "MARATHON";
	document.getElementById('status_cible').style.display = "block";
	if(seg){
		start();
		document.getElementById('status').style.display = 'block';
		seg = false;
		FIN = false;
	}
	function LED_rand(){
		a = getRandomInt(2);
		b = getRandomInt(2);
		c = getRandomInt(2);
	}
	LED_rand();
	if(!FIN){
		if(a == 0 && b == 0 && c == 0){
			LED_rand();
		}else{
			$.ajax({
				async:	true, 
				type: "GET",
				url: ip,
				data: "LED="+a+b+c,
				dataType:"html"
			});
		}
		setTimeout('MARATHON()',2000);
	}else{
		$.ajax({
				async:	true, 
				type: "GET",
				url: ip,
				data: "Start",
				dataType:"html"
			});
		seg = true;
	}
}
function CONTRAT(){
	document.getElementById('jeu_select').innerHTML = "CONTRAT";
	document.getElementById('status_cible').style.display = "block";
	var LED_activo = ["001","010","100"];
	var indicador = 0;
	if(seg){
		start();
		document.getElementById('status').style.display = 'block';
		seg = false;
		FIN = false;
	}
	indicador = getRandomInt(3);
	if(!FIN){
			$.ajax({
				async:	true, 
				type: "GET",
				url: ip,
				data: "LED="+LED_activo[indicador]+"&jeu=2",
				dataType:"html"
			});
		setTimeout('CONTRAT()',2000);
	}else{
		$.ajax({
				async:	true, 
				type: "GET",
				url: ip,
				data: "Start",
				dataType:"html"
			});
		seg = true;
	}
}
function borrar(){
	location.href = "limpiar.php";
}
function IP(CIBLE_IP){
	if(!CIBLE_IP){
		ip = "http://" + document.getElementById("url_ip").value;
		alert("Connectecté à: " + ip);
	}else{
		ip = "http://" + document.getElementById("success").innerHTML;
		alert("Connectecté à: " + ip);
	}
	document.getElementById("Dir_IP").innerHTML = ip;
}
</script>
<footer class="w3-container w3-bottom w3-theme w3-margin-top">
  <a>LP SEICOM - 2019</a>
  <button onclick="document.getElementById('status').style.display='block'" class="w3-right w3-button w3-black">STATUS</button>
  <button onclick="document.getElementById('p2').style.display='block'" class="w3-right w3-button w3-black">PTS</button>
</footer>
</body>
</html>